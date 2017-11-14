<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseMetadata extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'course_metadata';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['course_id','metadata_type_id', 'metadata_store_id', 'value'];
}
