<?php

namespace EONConsulting\Storyline2\Models;

use Illuminate\Database\Eloquent\Model;
use EONConsulting\Storyline2\Models\StorylineItem;

class StorylineItemType extends Node {
    //Enable Nested Sets//
    //use NodeTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lk_storyline_item_type';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'class'
    ];

    /**
     * Fetch the content for this model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function content()
    {
        return $this->belongsTo(StorylineItem::class);
    }
    
}
