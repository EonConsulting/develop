<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SummaryModuleProgression extends Model
{

  /**
   * Table name.
   *
   * @var string
   */
    protected $table = 'summary_module_progression';
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
        'progress_type_id', 'course_id', 'storyline_id', 'module_progress', 
        'class_progress', 'progress_date'
    ];
}
