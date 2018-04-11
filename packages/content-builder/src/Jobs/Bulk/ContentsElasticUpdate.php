<?php

namespace EONConsulting\ContentBuilder\Jobs\Bulk;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EONConsulting\ContentBuilder\Models\Content;
use Illuminate\Support\Facades\Log;
use EONConsulting\Core\Services\Elastic\Elastic;
use Exception;

class ContentsElasticUpdate implements ShouldQueue
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

        $content = Content::where('ingested', '0')->take(500)->get();

        if($content->count() < 1)
        {
            Log::debug("Finished content sync to Elastic");
            return true;
        }

        foreach($content as $item)
        {

            try {

                $courses = $item->storyline_items->map(function ($storyline_item) {
                    return optional($storyline_item->storyline)->course_id;
                })->implode(",");

                $categories = $item->categories()->pluck('name')->implode(",");

                $response = $elastic->type("external")
                    ->index("content")
                    ->id($item->id)
                    ->insert([
                        'content_id' => $item->id,
                        'title' => $item->title,
                        'body' => $item->body,
                        'description' => $item->description,
                        'tags' => $item->tags,
                        'course_ids' => $courses,
                        'categories' => $categories
                    ]);

                if($response->result == 'updated' || $response->result == 'created')
                {
                    Log::debug("ContentsElasticUpdate: POST of item id: {$item->id} to index: [content] was successful {$response->result}");

                    $item->ingested = 1;
                    $item->update();

                } else {
                    Log::error("ContentsElasticUpdate: POST of item id:  {$item->id} to index: [content] failed :: " . $e->getMessage());
                }

            } catch(Exception $e)
            {
                Log::error("ContentsElasticUpdate: POST of item id:  {$item->id} to index: [content] failed :: " . $e->getMessage());
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
        Log::debug('ContentsElasticUpdate: ' . $exception->getMessage());
    }
}