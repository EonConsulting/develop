<?php

namespace EONConsulting\TaoClient\Observers;

use EONConsulting\TaoClient\Models\TaoAssessment;
use EONConsulting\Storyline2\Models\StorylineItem;
use EONConsulting\ContentBuilder\Models\Content;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Log;

class StoryLineItemObserver
{

    /**
     * Listen to the StorylineItem saved event.
     *
     * @param  \EONConsulting\Storyline2\Models\StorylineItem  $storyline_item
     * @return void
     */
    public function saved(StorylineItem $storyline_item)
    {

        try {

            $content = Content::findOrFail($storyline_item->content_id);

        } catch(ModelNotFoundException $e)
        {
            Log::debug('StoryLineItemObserver: [Content] | ' . $e->getMessage());

            return true;
        }

        if( ! $launch_url = $this->getLaunchUrl($content->body))
        {
            return true;
        }

        try {

            $assessment = TaoAssessment::byLaunchUrl($launch_url)->firstOrFail();

        } catch(ModelNotFoundException $e)
        {
            Log::debug('StoryLineItemObserver: [TaoAssessment] | ' . $e->getMessage());

            return true;
        }

        $assessment->storyline_item_id = $storyline_item->id;

        $assessment->save();

        return true;
    }

    protected function getLaunchUrl($content)
    {
        preg_match("/src\=\"(.*?)\" /", $content, $match);

        if( ! isset($match[1]))
        {
            return false;
        }

        $match = explode('?launch_url=', $match[1]);

        if( ! isset($match[1]))
        {
            return false;
        }

        return $match[1];
    }


}
