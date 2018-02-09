<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimelineEvent extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'timeline_events';

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
        'user_id', 'course_id', 'title', 'type', 'start', 'end', 'url'
    ];
    
}
