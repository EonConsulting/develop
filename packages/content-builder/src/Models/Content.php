<?php

namespace EONConsulting\ContentBuilder\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model {

    protected $table = 'content';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'body', 'tags', 'creator_id'];

    public function creator() {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function categories() {
        return $this->belongsToMany('EONConsulting\ContentBuilder\Models\Category', 'content_categories')->withTimestamps();;
    }
    
}
