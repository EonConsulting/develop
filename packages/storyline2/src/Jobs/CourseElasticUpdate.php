<?php

namespace EONConsulting\Storyline2\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use EONConsulting\Core\Services\Elastic\Elastic;
use Exception;
use EONConsulting\Storyline2\Models\Course;

class CourseElasticUpdate implements ShouldQueue
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

    /*
     * Course Model
     */
    protected $course;

    /**
     * Create a new job instance.
     *
     * @param  Asset  $asset
     * @return void
     */
    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    /**
     * Execute the job.
     *
     * @param  Elastic  $elastic
     * @return void
     */
    public function handle(Elastic $elastic)
    {
        try {

            $response = $elastic->type("external")
                ->index("courses")
                ->id($this->course->id)
                ->update([
                    "id" => $this->course->id,
                    "title" => $this->course->title,
                    "description" => $this->course->description,
                    "tags" => $this->course->tags
                ]);

            return true;

        } catch(Exception $e)
        {
            Log::debug('CourseElasticUpdate: ' . $e->getMessage());

            return false;
        }

    }

    /**
     * The job failed to process.
     *
     * @param  Exception  $exception
     * @return void
     */
    public function failed(Exception $exception)
    {
        Log::debug('CourseElasticUpdate: ' . $exception->getMessage());
    }
}