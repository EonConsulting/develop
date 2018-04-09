<?php

namespace EONConsulting\ContentBuilder\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EONConsulting\ContentBuilder\Models\Content;
use Illuminate\Support\Facades\Log;
use EONConsulting\Core\Services\Elastic\Elastic;
use Exception;

class ContentElasicUpdate implements ShouldQueue
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
     * Content Model
     */
    protected $content;

    /**
     * Create a new job instance.
     *
     * @param  Content  $content
     * @return void
     */
    public function __construct(Content $content)
    {
        $this->content = $content;
    }

    /**
     * Execute the job.
     *
     * @param  AudioProcessor  $processor
     * @return void
     */
    public function handle(Elastic $elastic)
    {

        try {

            $courses = $this->content->storyline_items->map(function ($storyline_item) {
                return optional($storyline_item->storyline)->course_id;
            })->implode(",");

            $categories = $this->content->categories()->pluck('name')->implode(",");

            $elastic->type("external")
                ->index("content")
                ->id($this->content->id)
                ->insert([
                    'content_id' => $this->content->id,
                    'title' => $this->content->title,
                    'body' => $this->content->body,
                    'description' => $this->content->description,
                    'tags' => $this->content->tags,
                    'course_ids' => $courses,
                    'categories' => $categories
                ]);

        } catch(Exception $e)
        {
            Log::debug('ContentElasicUpdate: ' . $e->getMessage());

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
        Log::debug('ContentElasicUpdate: ' . $exception->getMessage());
    }
}