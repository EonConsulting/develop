<?php

namespace EONConsulting\TaoClient\Observers;

use EONConsulting\TaoClient\Models\TaoAssessment;
use EONConsulting\Storyline2\Models\StorylineItem;
use EONConsulting\ContentBuilder\Models\Content;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use EONConsulting\TaoClient\Helpers;
use Log;

class StoryLineItemObserver
{

    /**
     * Listen to the StorylineItem saving event.
     *
     * @param  \EONConsulting\Storyline2\Models\StorylineItem  $storyline_item
     * @return void
     */
    public function saving(StorylineItem $storyline_item)
    {
        try {

            $content = Content::findOrFail($storyline_item->content_id);

        } catch(ModelNotFoundException $e)
        {
            Log::debug('StoryLineItemObserver: [Content] | ' . $e->getMessage());

            return true;
        }

        return $this->updateTaoAssessment($content->body, $storyline_item->id);
    }

    /**
     * Find Tao Assessment record and update it with storyline item id
     *
     * @param $content_body
     * @param $storyline_item_id
     * @return bool
     */
    protected function updateTaoAssessment($content_body, $storyline_item_id)
    {
        if( ! $launch_url = Helpers::getLaunchUrl($content_body))
        {
            return false;
        }

        try {

            $assessment = TaoAssessment::byLaunchUrl($launch_url)->firstOrFail();

            $assessment->storyline_item_id = $storyline_item_id;

            $assessment->save();

        } catch(ModelNotFoundException $e)
        {
            Log::debug('StoryLineItemObserver: [TaoAssessment] | ' . $e->getMessage());
            return false;
        }

        return true;
    }
}
