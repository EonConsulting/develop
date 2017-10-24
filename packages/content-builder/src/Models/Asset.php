<?php

namespace EONConsulting\ContentBuilder\Models;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    protected $table = 'assets';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'tags'];

    public function content() {
        return $this->belongsToMany('EONConsulting\ContentBuilder\Models\Content', 'content_categories');
    }

}
