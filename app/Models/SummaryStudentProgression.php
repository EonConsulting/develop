<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SummaryStudentProgression extends Model
{

  /**
   * Table name.
   *
   * @var string
   */
    protected $table = 'summary_student_progression';
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
        'progress_type_id', 'course_id', 'student_user_id', 'progress', 'video_progress',
        'ebook_progress'
    ];
}
