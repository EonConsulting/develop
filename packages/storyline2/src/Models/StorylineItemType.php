<?php

namespace EONConsulting\Storyline2\Models;

use Illuminate\Database\Eloquent\Model;
use EONConsulting\Storyline2\Models\StorylineItem;

class StorylineItemType extends Node {


    protected $table = 'lk_storyline_item_type';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'description', 'class', 'level'
    ];

    public function StorylineItem(){
        return $this->belongsTo(StorylineItem::class);
    }
    
    
}
