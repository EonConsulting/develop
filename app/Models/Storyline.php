<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Storyline extends Model {

    protected $table = 'storylines';
    protected $primaryKey = 'id';
    protected $fillable = ['course_id', 'version', 'creator_id'];

    public function creator() {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function course() {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function items() {
        return $this->hasMany(StorylineItem::class, 'storyline_id', 'id')
            ->orderBy('level', 'ASC')
            ->orderBy('position', 'ASC');
    }

//    public function items() {
//        return $this->hasMany(StorylineItem::class, 'storyline_id', 'id')->orderBy('level', 'ASC');
//    }


}
