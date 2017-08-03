<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseUser extends Model {

    protected $table = 'course_users';
    protected $primaryKey = 'id';
    protected $fillable = ['course_id', 'user_id', 'email', 'opted_out', 'opted_out_date'];

    public function course() {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
