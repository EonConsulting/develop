<?php

namespace EONConsulting\Exports\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\User;
use Exception;
use Storage;

use EONConsulting\{
    Storyline2\Models\StorylineItem,
    Core\Helpers\CourseExportHelper,
    Exports\Models\FileExport,
    Exports\Models\FaultyFileExport
};

use Facades\ {
    EONConsulting\Core\Services\Pandoc
};

class SinglePdfExportJob implements ShouldQueue
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
     * @var \EONConsulting\Storyline2\Models\StorylineItem
     */
    protected $storyline_item;

    /**
     * @var \App\Models\User
     */
    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(StorylineItem $storyline_item, User $user = null)
    {
        $this->user = $user ?? auth()->user();
        $this->storyline_item = $storyline_item;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Log::debug('---------------------------------------------------------------');
        \Log::debug($this->storyline_item);
        \Log::debug('---------------------------------------------------------------');

        if(\Storage::disk('storage')->exists($this->getPath()))
        {
            \Log::debug('Deleting Dir!');
            Storage::disk('storage')->deleteDirectory($this->getPath());
        }

        $body = optional($this->storyline_item->content)->body;

        if(is_null($body))
        {
            throw new Exception('No content was found.');
        }

        $body = CourseExportHelper::removeJavaScript($body);

        $html = view('exports::pdf.master')->withContent(urldecode($body))->render();

        $pandoc = Pandoc::setBasepath($this->getPath())->fromContent($html)->singlePdf()->generate();

        $file_export = new FileExport([
            'filetype' => 'pdf',
            'filename' => $this->getPath() . '/item.pdf',
            'filesystem' => 'storage',
        ]);

        $this->storyline_item->attach_exported_file($file_export);
    }

    /**
     * The job failed to process.
     *
     * @param  Exception  $exception
     * @return void
     */
    public function failed(Exception $exception)
    {
        $faulty_file = new FaultyFileExport([
            'filetype' => 'pdf',
            'message' => 'Unable to convert storyline item for pdf download.',
            'exception' => $exception->getMessage(),
        ]);

        $this->storyline_item->attach_exported_file($faulty_file);
    }

    protected function getPath()
    {
        $course_id = optional($this->storyline_item->storyline)->course_id;

        return "exports/single-pdf/{$course_id}/{$this->storyline_item->id}";
    }


}