<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Baum\Node;

class Story extends Node
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stories';

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
        'storyline_id','title','description', 'file_name', 'file_url'
    ];

    /*
     * Get the Storyline ID Associated with Story
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function storyline()
    {
        return $this->belongsTo(Storyline::class, 'storyline_id', 'id');
    }

    /*
     * Get the parent storyline item
     *
     * Forget Parent and Children Foreign Keys
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function parent()
    {
        return $this->belongsTo(StorylineItem::class, 'parent_id', 'id');
    }

    /*
     * Get the children storyline item
     */
    public function children()
    {
        return $this->hasMany(StorylineItem::class, 'id', 'parent_id');
    }
}
