<?php

namespace EONConsulting\Storyline2\Models;

use Illuminate\Database\Eloquent\Model;
use EONConsulting\Storyline2\Models\Storyline;
use EONConsulting\Storyline2\Models\Template;
use App\Models\User;

class Course extends Model {

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
        'title', 'description', 'featured_image', 'tags', 'xml_file', 'creator_id'
    ];

    /**
     * Fetch the creator of this model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    /**
     * Fetch storylines for this model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function storylines()
    {
        return $this->hasMany(Storyline::class, 'course_id', 'id');
    }

    /**
     * Fetch latest storyline for this model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function latest_storyline()
    {
        return $this->hasOne(Storyline::class, 'course_id', 'id')->orderBy('created_at', 'DESC')->first();
    }

    /**
     * Fetch course users for this model
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'integrate_course_users', 'course_id', 'user_id');
    }
    
    public function template()
    {
        return $this->belongsTo(Template::class, 'template_id', 'id');
    }
}
