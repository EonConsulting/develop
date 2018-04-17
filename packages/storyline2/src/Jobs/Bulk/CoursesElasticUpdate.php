<?php

namespace EONConsulting\Storyline2\Jobs\Bulk;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use EONConsulting\Core\Services\Elastic\Elastic;
use Exception;
use EONConsulting\Storyline2\Models\Course;

class CoursesElasticUpdate implements ShouldQueue
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
    public $timeout = 360;

    /**
     * Execute the job.
     *
     * @param  Elastic  $elastic
     * @return void
     */
    public function handle(Elastic $elastic)
    {

        $courses = Course::where('ingested', '0')->take(500)->get();

        if($courses->count() < 1)
        {
            Log::debug("CoursesElasticUpdate: Finished courses sync to Elastic");
            return true;
        }

        foreach($courses as $course)
        {
            try {

                $response = $elastic->type("external")
                    ->index("courses")
                    ->id($course->id)
                    ->update([
                        "id" => $course->id,
                        "title" => $course->title,
                        "description" => $course->description,
                        "tags" => $course->tags
                    ]);

                if($response->result == 'updated' || $response->result == 'created')
                {
                    Log::debug("CoursesElasticUpdate: POST of item id: {$course->id} to index: [courses] was successful {$response->result}");

                    $course->ingested = 1;
                    $course->update();

                } else {
                    Log::error("CoursesElasticUpdate: POST of item id:  {$course->id} to index: [courses] failed :: " . $e->getMessage());
                }

            } catch(Exception $e)
            {
                Log::error("CoursesElasticUpdate: POST of item id:  {$course->id} to index: [courses] failed :: " . $e->getMessage());
            }
        }

        return true;
    }

    /**
     * The job failed to process.
     *
     * @param  Exception  $exception
     * @return void
     */
    public function failed(Exception $exception)
    {
        Log::debug('CoursesElasticUpdate: ' . $exception->getMessage());
    }
}