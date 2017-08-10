<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model {

    protected $table = 'courses';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'description', 'featured_image', 'tags', 'xml_file', 'creator_id'];

    public function creator() {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function storylines() {
        //return $this->hasMany(Storyline::class, 'course_id', 'id');
        return $this->hasOne(Storyline::class, 'course_id', 'id');
    }

    public function latest_storyline() {
        return $this->hasOne(Storyline::class, 'course_id', 'id')->orderBy('created_at', 'DESC')->first();
    }

    public function users() {
        return $this->hasMany(CourseUser::class, 'course_id', 'id');
    }



}
