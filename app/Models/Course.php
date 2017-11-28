<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'courses';

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
        'title', 'description', 'featured_image', 'tags', 'xml_file', 'creator_id', 'template_id', 'ingested'
    ];

    /**
     * Fetch the creator for the course.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    /**
     * Fetch the storyline for the course.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function storylines()
    {
        //return $this->hasMany(Storyline::class, 'course_id', 'id');
        return $this->hasOne(Storyline::class, 'course_id', 'id');
    }

    /**
     * Fetch the latest storyline for the course.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function latest_storyline()
    {
        return $this->hasOne(Storyline::class, 'course_id', 'id')->orderBy('created_at', 'DESC')->first();
    }

    /**
     * Fetch the users for the course.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function users()
    {
        return $this->hasMany(CourseUser::class, 'course_id', 'id');
    }
}
