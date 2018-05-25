<?php

namespace EONConsulting\Exports\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\User;
use Storage;
use Exception;

use EONConsulting\{
    Notifications\Notifications\Jobs\JobNotification,
    Storyline2\Models\Course,
    Exports\Models\FileExport,
    Exports\Models\FaultyFileExport,
    Core\Converters\Components\ItemTransformer
};

use Facades\ {
    EONConsulting\Core\Converters\CourseToHtml
};

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
    public $timeout = 600;

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
        CourseToHtml::setup($this->course);

        $storyline = $this->course->latest_storyline();

        $items = $storyline->items()
            ->where('name', '!=', 'Root')
            ->with(['content'])->get()
            ->toHierarchy();

        CourseToHtml::createExportFolder();

        $storyline_items = ItemTransformer::transform($items)->recursive();

        foreach($storyline_items as $item)
        {
            CourseToHtml::createPages($item, $storyline_items);
        }

        CourseToHtml::createZipFile();

        /*
         * Disabled as per ticket (Unisa E-ContentUES-17)
         *
        $notification = [
            'title' => 'Full Course Export',
            'message' => "Full course export finished for [" . $this->course->id . "] title: " . $this->course->title,
        ];

        $this->user->notify(
            new JobNotification($notification)
        );
        */

        $file_export = new FileExport([
            'filetype' => 'zip',
            'filename' => CourseToHtml::getZipFilePath(),
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
        CourseToHtml::cleanTmp();

        /*
         * Disabled as per ticket (Unisa E-ContentUES-17)
         *
        $notification = [
            'title' => 'Job Running Error',
            'message' => "Something went wrong running the full course export job.\n\n Unable to export course [" . $this->course->id . "] title: " . $this->course->title,
            'debugging' => $exception->getMessage(),
        ];

        $this->user->notify(
            new JobNotification($notification)
        );
        */

        $faulty_file = new FaultyFileExport([
            'filetype' => 'zip',
            'message' => 'Unable to export the entire course for download.',
            'exception' => $exception->getMessage(),
        ]);

        $this->course->attach_exported_file($faulty_file);
    }


}