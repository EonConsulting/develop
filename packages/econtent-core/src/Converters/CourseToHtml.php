<?php

namespace EONConsulting\Core\Converters;

use Dropbox\Exception;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use EONConsulting\Core\Helpers\HtmlToDom\HtmlHandler;
use EONConsulting\Core\Converters\Components\Menu;
use Illuminate\Support\Facades\Log;
use Storage;
use Zip;

use EONConsulting\Exports\Filters\Filter;
use EONConsulting\Exports\Filters\AssetFilter;

class CourseToHtml
{

    protected $course;

    public function setup($course)
    {
        $this->course = $course;

        $this->clearOldFiles();
    }

    public function makeIncludePath($level)
    {
        return str_repeat('../', $level) . 'includes/';
    }

    public function createZipFile()
    {
        $zip = Zip::create($this->getZipFilePath(true));

        $zip->add($this->getTempPath('assets',true));
        $zip->add($this->getTempPath('pages',true));
        $zip->add($this->getTempPath('../includes',true));

        $zip->close();

        $this->fixPermission();

        $this->cleanTmp();
    }

    public function cleanTmp()
    {
        return Storage::disk('storage')->deleteDirectory($this->getTempPath());
    }

    /**
     * Get the relative path for the current storyline item
     *
     * @param $current_item
     * @param $node
     * @return mixed
     */
    public function getRelativePath($current_item, $node)
    {
        $path = ltrim(str_repeat('../', $current_item->get('level') - 1) . $node->get('path') . '/', '/');

        return str_replace('//', '/', $path);
    }

    public function getTempPath($filename = '', $fullpath = false)
    {
        $path = "exports/full-html-course/tmp-{$this->course->id}/" . $filename;

        if($fullpath)
        {
            return Storage::disk('storage')->path($path);
        }

        return $path;
    }

    public function getZipFilePath($fullpath = false)
    {
        $path = "exports/full-html-course/course-{$this->course->id}.zip";

        if($fullpath)
        {
            return Storage::disk('storage')->path($path);
        }

        return $path;
    }

    /*
     * Check to see if zip file exists and if so remove it.
     */
    public function clearOldFiles()
    {
        if(Storage::disk('storage')->exists($this->getZipFilePath()))
        {
            Storage::disk('storage')->delete($this->getZipFilePath());
        }
    }

    /*
     * Fix permission on the generated zip file
     */
    public function fixPermission()
    {
        $command = "/bin/chown -R www-data:www-data " . $this->getZipFilePath(true);

        $process = new Process($command);

        try {

            $process->mustRun();

        } catch (ProcessFailedException $e) {

            \Log::debug($e->getMessage());
        }
    }

    /**
     * Create the export folder if it does not exist
     */
    public function createExportFolder()
    {
        if(Storage::disk('storage')->exists($this->getTempPath()))
        {
            Storage::disk('storage')->deleteDirectory($this->getTempPath());
        }

        Storage::disk('storage')->makeDirectory($this->getTempPath('pages'));
        Storage::disk('storage')->makeDirectory($this->getTempPath('assets/images'));
        Storage::disk('storage')->makeDirectory($this->getTempPath('assets/videos'));
        Storage::disk('storage')->makeDirectory($this->getTempPath('assets/other'));
    }

    /**
     * Move the javascript code into the right place on the page
     *
     * @param $body
     * @return array|null
     */
    public function moveJavascript($body)
    {
        if(is_null($body))
        {
            return null;
        }

        $javascript = '';

        if( ! $html = HtmlHandler::strGetHtml($body))
        {
            return compact('javascript','body');
        }

        $html = HtmlHandler::strGetHtml((string) $body);

        if( ! $html->find("script"))
        {
            return compact('javascript','body');
        }

        foreach($html->find("script") as $js)
        {
            if( ! $js->hasAttribute('src'))
            {
                $javascript .= $js->outertext;

                $js->outertext = '';
            }
        }

        $body = $html;

        return compact('javascript','body');
    }

    /**
     * Create the page for the storyline item
     *
     * @param $item
     * @return bool
     * @throws \Throwable
     */
    public function createPages($item, $storyline_items)
    {

        $content = $item->get('content');

        if($content)
        {
            try {

                $filter = new Filter(new AssetFilter($content, $this->getTempPath(), $item->get('level')));

                $content = $filter->getContent();

            } catch(\Exception $e)
            {
                if($e->getMessage() != 'No assets found in content!')
                {
                    Log::debug($e->getMessage());
                }

            }
        }

        $body_and_javascript = $this->moveJavascript($content);

        $content = $body_and_javascript['body'];
        $javascript = $body_and_javascript['javascript'];

        $includes_path = $this->makeIncludePath($item->get('level'));

        $menu = Menu::make($storyline_items)->build($item);

        $content = view('exports::course-export', compact('content', 'includes_path', 'javascript', 'menu'))->render();

        $filepath = $this->getTempPath('pages/' . $item->get('path') . '/' . $item->get('filename'));

        Storage::disk('storage')->put($filepath, $content);

        if($children = $item->get('children'))
        {
            foreach($children as $child)
            {
                $this->createPages($child, $storyline_items);
            }
        }

        return true;
    }
}