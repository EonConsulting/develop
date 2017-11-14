<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Storyline extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'storylines';

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
        'course_id', 'version', 'creator_id'
    ];

    /**
     * Fetch the creator for the storyline.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    /**
     * Fetch the course for this storyline.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    /**
     * Fetch the story line items for this storyline.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function items()
    {
        return $this->hasMany(StorylineItem::class, 'storyline_id', 'id')
                        ->orderBy('level', 'ASC')
                        ->orderBy('position', 'ASC');
    }

    /**
     * Fetch metadata for this storyline
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function metadata()
    {
        return $this->hasMany(StorylineMetadata::class, 'storyline_id', 'id');
    }
}
