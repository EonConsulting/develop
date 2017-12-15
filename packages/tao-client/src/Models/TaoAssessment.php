<?php

namespace EONConsulting\TaoClient\Models;

use Illuminate\Database\Eloquent\Model;
use EONConsulting\Storyline2\Models\StorylineItem;

class TaoAssessment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tao_assessments';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get story line items for this model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function storyline_item()
    {
        return $this->belongsTo(StorylineItem::class, 'id', 'storyline_item_id');
    }

    /**
     * Scope a query to only include launch urls by provided value.
     *
     * @param string $launch_url
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopebyLaunchUrl($query, $launch_url)
    {
        return $query->where('launch_url', $launch_url);
    }
}