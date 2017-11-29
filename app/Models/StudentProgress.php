<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentProgress extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'student_progress';

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
    protected $fillable = [
        'student_id', 'course_id', 'storyline_id', 'visited'
    ];
}
