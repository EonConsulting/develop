<?php

namespace EONConsulting\Exports\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;

use EONConsulting\{
    Storyline2\Models\Course,
    Core\Helpers\HtmlToDom\HtmlHandler,
    Core\Helpers\HtmlToDom\SimpleHtmlDom,
    Exports\Models\FileExport,
    Exports\Models\FaultyFileExport,
    Exports\Jobs\SinglePdfExportJob,
    Notifications\Notifications\Jobs\JobNotification
};

use Facades\ {
    EONConsulting\Core\Services\Pandoc
};

class CoursePdfExportJob implements ShouldQueue
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
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Course $course, User $user = null)
    {
        $this->user = $user ?? auth()->user();
        $this->course = $course;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $failed_items = $this->course->latest_storyline()->items()->where('parent_id', '!=', 'null')->whereHas('faulty_file', function ($query) {
            $query->where('filetype', 'like', '%');
        });

        if($failed_items->count() > 0)
        {
            $notification = [
                'title' => 'Full Course PDF Export',
                'message' => "Some Storyline items failed to generate pdf's, please manually correct them. [" . $this->course->id . "] title: " . $this->course->title,
            ];

            $this->user->notify(
                new JobNotification($notification)
            );

            return;
        }

        $items = $this->course->latest_storyline()->items()->where('parent_id', '!=', 'null')->with(['content'])->get();

        $exported_items = $this->course->latest_storyline()->items()->where('parent_id', '!=', 'null')->whereHas('exported_file', function ($query) {
            $query->where('filetype', 'pdf');
        });

        if($items->count() != $exported_items->count())
        {
            foreach($items as $item)
            {
                SinglePdfExportJob::dispatch($item);
            }

            return;
        }

        $items = $items->toHierarchy();

        $collection = $this->transformStorylineItems($items)->recursive();

        $master_html = '';

        foreach($collection as $item)
        {
            $master_html.= $this->buildContent($item);
        }

        $html = view('exports::pdf.master')->withContent($master_html)->render();

        $pandoc = Pandoc::setBasepath($this->getPath())->fromContent($html)->multiplePages()->generate();

        $notification = [
            'title' => 'Pdf Course Export',
            'message' => "Pdf course export finished for [" . $this->course->id . "] title: " . $this->course->title,
        ];

        $this->user->notify(
            new JobNotification($notification)
        );

        $file_export = new FileExport([
            'filetype' => 'pdf',
            'filename' => $this->getPath() . '/item.pdf',
            'filesystem' => 'storage',
        ]);

        $this->course->attach_exported_file($file_export);
    }

    /**
     * The job failed to process.
     *
     * @param  Exception  $exception
     * @return void
     */
    public function failed(Exception $exception)
    {
        $notification = [
            'title' => 'Job Running Error',
            'message' => "Something went wrong running the pdf course export job.\n\n Unable to export course [" . $this->course->id . "] title: " . $this->course->title,
            'debugging' => $exception->getMessage(),
        ];

        $this->user->notify(
            new JobNotification($notification)
        );

        $faulty_file = new FaultyFileExport([
            'filetype' => 'pdf',
            'message' => 'Unable to convert storyline item for pdf download.',
            'exception' => $exception->getMessage(),
        ]);

        $this->course->attach_exported_file($faulty_file);
    }

    protected function getPath()
    {
        return "exports/course-pdf/{$this->course->id}";
    }

    /**
     * Transform each item in the collection using a callback.
     *
     * @param  callable  $callback
     * @return $this
     */
    public function transformStorylineItems($nodes, $level = 0)
    {
        $collection = [];

        $level++;

        foreach($nodes as $node)
        {
            $collection[] = [
                'id' => $node->id,
                'name' => $node->name,
                'level' => $level,
                'content_id' => optional($node->content)->id,
                'content' => optional($node->content)->body,
                'children' => $this->transformStorylineItems(
                    $node->children,
                    $level
                ),
            ];
        }

        return collect($collection);
    }

    protected function buildContent($item)
    {
        $master_html = '';

        $body = $item->get('content');

        $title = str_slug($item->get('name'));
        $content_id = $item->get('content_id');

        if($body != '')
        {
            $html = HtmlHandler::strGetHtml($body);

            if( $html->find('h3', 0))
            {
                $h_title = $html->find('h3', 0)->innertext;
                $h_level = $item->get('level');

                $html->find('h3', 0)->outertext = "<h{$h_level}>{$h_title}</h{$h_level}>";
            }

            $body = $html;
        }

        $master_html = "<section id=\"my_section\" class=\"level2 page-breaker\">" . $body . "</section><div style=\"page-break-after: always;\"></div>";

        if($children = $item->get('children'))
        {
            foreach($children as $child)
            {
                $master_html.= $this->buildContent($child);
            }
        }

        return $master_html;
    }
}