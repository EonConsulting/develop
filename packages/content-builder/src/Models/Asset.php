<?php

namespace EONConsulting\ContentBuilder\Models;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model {

    protected $table = 'assets';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'description', 'content', 'tags', 'file_name', 'mime_type', 'size', 'creator_id', 'import_count'];

    public function creator() {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function categories() {
        return $this->belongsToMany('EONConsulting\ContentBuilder\Models\Category', 'asset_categories')->withTimestamps();
    }

}
