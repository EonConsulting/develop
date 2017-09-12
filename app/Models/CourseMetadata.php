<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseMetadata extends Model {

    protected $table = 'course_metadata';
    protected $primaryKey = 'id';
    protected $fillable = ['course_id', 'metadata_store_id', 'value'];

}
