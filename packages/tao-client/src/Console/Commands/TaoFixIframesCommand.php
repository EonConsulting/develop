<?php

namespace EONConsulting\TaoClient\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use EONConsulting\ContentBuilder\Models\Content;
use EONConsulting\Storyline2\Models\StorylineItem;
use EONConsulting\TaoClient\Models\TaoAssessment;
use EONConsulting\TaoClient\Helpers;

class TaoFixIframesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'taoclient:fix-iframes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix iframe content for tao assessments';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $content = Content::all();

        foreach($content as $text)
        {
            if( ! $launch_url = Helpers::getLaunchUrl($text->body))
            {
                $this->error('No Tao Found. ' . $text->title);
                continue;
            }

            try {

                $storyline_item = StorylineItem::where('content_id', $text->id)->firstOrFail();

            } catch(ModelNotFoundException $e)
            {
                $this->error($e->getMessage());
                continue;
            }

            $assessment = TaoAssessment::firstOrCreate([
                'storyline_item_id' => $storyline_item->id,
                'launch_url' => $launch_url,
            ],[
                'storyline_item_id' => $storyline_item->id,
                'launch_url' => $launch_url,
                'key' => config('tao-client.launch-options.key'),
                'secret' => config('tao-client.launch-options.secret'),
            ]);

            $text->body = $this->createIframe($launch_url);

            $text->save();

            $this->info('Updated ' . $storyline_item->name);
        }
    }

    protected function createIframe($launch_url)
    {
        return '<div class="iframeCover"><iframe allowtransparency="true" class="ckeditorframe" scrolling="yes" frameborder="0" src="' . route('tao-client.show') . '?launch_url=' . $launch_url . '" type="text/html" width="100%" height="800px"></iframe></div>';
    }
}