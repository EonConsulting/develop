<?php

namespace EONConsulting\Storyline2\Models;

use Illuminate\Database\Eloquent\Model;
use Baum\Node;
use EONConsulting\ContentBuilder\Models\Content;

class StorylineItem extends Node {
    //Enable Nested Sets//
    //use NodeTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'storyline_items';

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
        'parent_id', 'storyline_id', 'root_parent', 'level', 'name', 'description', 'file_name', 'file_url','content_id'
    ];

    //Set Scope for Storyline Construction
    protected $scoped = ['storyline_id'];
    protected static $holdCurrentStoryLineId;
    protected $parentColumn = 'parent_id';
    protected $leftColumn = '_lft';
    protected $rightColumn = '_rgt';
    protected $depthColumn = 'level';

    protected $guarded = array('id','_lft', '_rgt', 'nesting');

    //Set Attribute Mutation
    public function __construct(array $attributes = array()) {
        $this->setRawAttributes(array(
            'storyline_id' => self::$holdCurrentStoryLineId
        ), true);
        parent::__construct($attributes);
    }

    /**
     * Fetch the storyline of this model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function storyline()
    {
        return $this->belongsTo(Storyline::class, 'storyline_id', 'id');
    }

    public static function currentStoryLine($storyline_id)
    {
        self::$holdCurrentStoryLineId = $storyline_id;
    }

    /**
     * Fetch the content for this model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function content()
    {
        //return $this->hasMany(Storyline::class, 'course_id', 'id');
        return $this->belongsTo(Content::class);
    }

    /**
     * Fetch the contents for this model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function contents()
    {
        return $this->belongsTo(Content::class, 'content_id', 'id');
    }
    
}
