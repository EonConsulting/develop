<?php

namespace EONConsulting\ContentBuilder\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model {

    protected $table = 'content';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'body', 'tags', 'creator_id','description'];

    public function creator() {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function categories() {
        return $this->belongsToMany('EONConsulting\ContentBuilder\Models\Category', 'content_categories')->withTimestamps();
    }

    public function storyline_items() {
        return $this->hasMany('EONConsulting\Storyline2\Models\StorylineItem', 'content_id')->withTimestamps();
    }
    
}
