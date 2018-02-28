<?php

namespace EONConsulting\Exports\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EONConsulting\Storyline2\Models\Course;
use EONConsulting\Core\Helpers\HtmlToDom\HtmlHandler;
use EONConsulting\Core\Helpers\HtmlToDom\SimpleHtmlDom;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use EONConsulting\Notifications\Notifications\Jobs\JobFailed;
use App\Models\User;
use Zip;
use Storage;
use Exception;

class CourseExportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 1;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 120;

    /**
     * @var \EONConsulting\Storyline2\Models\Course
     */
    protected $course;

    /**
     * @var \App\Models\User
     */
    protected $user;

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $storyline_items;

    /*
     * @var string
     */
    protected $storage_path;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, Course $course)
    {
        $this->user = $user;
        $this->course = $course;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $this->clearOldFiles();

        $storyline = $this->course->latest_storyline();

        $items = $storyline->items()->with(['content'])->get()
            ->toHierarchy();

        $this->storage_path = 'exports/full-html-course/tmp/';

        $this->createExportFolder();

        $collection = $this->transformStorylineItems($items)->recursive();

        $this->storyline_items = $collection;

        foreach($this->storyline_items as $item)
        {
            $this->createPages($item);
        }

        $zip = Zip::create(storage_path($this->storage_path . '/../course-' . $this->course->id . '.zip'));

        $zip->add(storage_path($this->storage_path . 'assets'));
        $zip->add(storage_path($this->storage_path . '/../includes'));
        $zip->add(storage_path($this->storage_path . 'pages'));

        $zip->close();

        $this->fixPermission();

        Storage::disk('storage')->deleteDirectory($this->storage_path);
    }

    /**
     * The job failed to process.
     *
     * @param  Exception  $exception
     * @return void
     */
    public function failed(Exception $exception)
    {
        \Log::debug($exception->getMessage());

        $notification = [
            'title' => 'Job Running Error',
            'message' => "Something went wrong running the full course export job.\n\n Unable to export course [" . $this->course->id . "] title: " . $this->course->title,
            'debugging' => $exception->getMessage(),
        ];

        $this->user->notify(
            new JobFailed($notification)
        );
    }

    /*
     * Fix permission on the generated zip file
     */
    protected function fixPermission()
    {
        $command = "sudo /bin/chown -R www-data:www-data " . storage_path($this->storage_path . '/../course-' . $this->course->id . '.zip');

        $process = new Process($command);

        try {

            $process->mustRun();

        } catch (ProcessFailedException $e) {

            \Log::debug($e->getMessage());
        }
    }

    /*
     * Check to see if zip file exists and if so remove it.
     */
    protected function clearOldFiles()
    {
        if(Storage::disk('storage')->exists('exports/courses/course-' . $this->course->id . '.zip'))
        {
            Storage::disk('storage')->delete('exports/courses/course-' . $this->course->id . '.zip');
        }
    }

    /**
     * Transform each item in the collection using a callback.
     *
     * @param  callable  $callback
     * @return $this
     */
    public function transformStorylineItems($nodes, $path = '', $level = 0)
    {
        $collection = [];

        $level++;

        foreach($nodes as $node) {

            $collection[] = [
                'id' => $node->id,
                'name' => $node->name,
                'is_leaf' => $node->isLeaf(),
                'filename' => str_slug($node->name) . '.html',
                'path' => $path,
                'level' => $level,
                'content' => optional($node->content)->body,
                'children' => $this->transformStorylineItems(
                    $node->children,
                    $this->transformPath($path, $node, $level),
                    $level
                ),
            ];
        }

        return collect($collection);
    }

    /**
     * Create a full folder for the storyline item
     *
     * @param $path
     * @param $node
     * @param int $level
     * @return string
     */
    protected function transformPath($path, $node, $level = 0)
    {
        if($level < 1)
        {
            return $path;
        }

        return ltrim($path . '/' . str_slug($node->name), '/');
    }

    /**
     * Create the page for the storyline item
     *
     * @param $item
     * @return bool
     * @throws \Throwable
     */
    protected function createPages($item)
    {
        $content = $this->copyAssets($item);

        $body_and_javascript = $this->moveJavascript($content);

        $content = $body_and_javascript['html'];
        $javascript = $body_and_javascript['javascript'];

        $includes_path = str_repeat('../', $item->get('level')) . 'includes/';

        $menu = $this->buildMenu($item);

        $content = view('ecore::course-export', compact('content', 'includes_path', 'javascript', 'menu'))->render();

        $filepath = $this->storage_path . 'pages/' . $item->get('path') . '/' . $item->get('filename');

        Storage::disk('storage')->put($filepath, $content);

        if($children = $item->get('children'))
        {
            foreach($children as $child)
            {
                $this->createPages($child);
            }
        }

        return true;
    }

    /**
     * Get the relative path for the current storyline item
     *
     * @param $current_item
     * @param $node
     * @return mixed
     */
    protected function getRelativePath($current_item, $node)
    {
        $path = ltrim(str_repeat('../', $current_item->get('level') - 1) . $node->get('path') . '/', '/');

        return str_replace('//', '/', $path);
    }

    /**
     * Build the navigation menu
     *
     * @param $current_item
     * @return string
     */
    protected function buildMenu($current_item)
    {
        $menu = '';

        foreach ($this->storyline_items as $item)
        {
            $menu .= $this->buildMenuItems($item, $current_item);
        }

        return $menu;
    }

    /**
     * Build the navigation menu
     *
     * @param $node
     * @param $current_item
     * @return string
     */
    protected function buildMenuItems($node, $current_item)
    {
        $relative_path = $this->getRelativePath($current_item, $node);

        $file = $relative_path .  $node->get('filename');

        $html = '';

        if ($node->get('is_leaf'))
        {
            return "<li><a href=\"{$file}\">{$node->get('name')}</a></li>";

        } else {

            $html .= "<li><a href=\"{$file}\">{$node->get('name')}</a>\n<ul>";

            if($children = $node->get('children'))
            {
                foreach ($children as $child)
                {
                    $html.= $this->buildMenuItems($child, $current_item);
                }
            }

            $html .= "</ul>\n</li>";
        }

        return $html;
    }

    /**
     * Copy the assets in the content and rewrite the paths to local folders
     *
     * @param $item
     * @return bool|\EONConsulting\Core\Helpers\HtmlToDom\SimpleHtmlDom|null
     */
    protected function copyAssets($item)
    {

        if( ! $item->get('content'))
        {
            return $item->get('content');
        }

        $html = HtmlHandler::strGetHtml($item->get('content'));

        if( ! $assets = $html->find('video, img, iframe'))
        {
            return $item->get('content');
        }

        foreach($assets as $asset)
        {
            try {

                $type = $this->getAssetType($asset->tag);

                $filename = basename($asset->src);

                $file_path = str_after($asset->src, env('APP_URL') . '/uploads/');

                $asset_content = Storage::disk('uploads')->get($file_path);

                Storage::disk('storage')->put($this->storage_path . 'assets/' . $type . '/' . $filename, $asset_content);

                $asset_folder = str_repeat('../', $item->get('level')) . 'assets/' . $type . '/' . $filename;

                $asset->src = $asset_folder;

            } catch(\Exception $e)
            {
                var_dump($asset->getAllAttributes());
                return null;
            }
        }

        return $html;
    }

    /**
     * Get the type of file
     *
     * @param $tag
     * @return string
     */
    protected function getAssetType($tag)
    {
        switch($tag)
        {
            case 'img':
                return 'images';
                break;

            case 'video':
                return 'videos';
                break;

            default:
                return 'other';
                break;
        }

        return 'other';
    }

    /**
     * Move the javascript code into the right place on the page
     *
     * @param $body
     * @return array|null
     */
    protected function moveJavascript($body)
    {
        if(is_null($body))
        {
            return null;
        }

        $javascript = '';

        if( ! $html = HtmlHandler::strGetHtml($body))
        {
            return compact('javascript','html');
        }

        if( ! $html->find("script"))
        {
            return compact('javascript','html');
        }

        foreach($html->find("script") as $js)
        {
            if( ! $js->hasAttribute('src'))
            {
                $javascript .= $js->outertext;

                $js->outertext = '';
            }
        }

        return compact('javascript','html');
    }

    /**
     * Create the export folder if it does not exist
     */
    protected function createExportFolder()
    {
        if(Storage::disk('storage')->exists($this->storage_path))
        {
            Storage::disk('storage')->deleteDirectory($this->storage_path);
        }

        Storage::disk('storage')->makeDirectory($this->storage_path);
    }
}
