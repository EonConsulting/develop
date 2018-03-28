<?php

namespace EONConsulting\Exports\Jobs;

use App\Models\User;
use EONConsulting\Storyline2\Models\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use EONConsulting\Exports\Jobs\CoursePdfExportJob;

class BulkPdfExportJob implements ShouldQueue
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
        $items = $this->course->latest_storyline()->items()->where('name', '!=', 'Root')->get();

        foreach($items as $item)
        {
            SinglePdfExportJob::dispatch($item, $this->user);
        }
    }
}
