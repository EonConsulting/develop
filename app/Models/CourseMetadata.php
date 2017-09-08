<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseMetadata extends Model {

    protected $table = 'course_metadata';
    protected $primaryKey = 'id';
    protected $fillable = ['course_id', 'lk_table', 'lk_table_id', 'value'];

}
