<?php

namespace EONConsulting\Storyline2\Models;

use Illuminate\Database\Eloquent\Model;
use Baum\Node;

class StorylineItem extends Node {
    //Enable Nested Sets//
    //use NodeTrait;
    protected $table = 'storyline_items';
    protected $primaryKey = 'id';
    protected $fillable = ['parent_id', 'storyline_id', 'root_parent', 'level', 'name', 'description', 'file_name', 'file_url','content_id'];
    //Set Scope for Storyline Construction
    protected $scoped = ['storyline_id'];
    protected static $holdCurrentStoryLineId;
    //Set Attribute Mutation
    public function __construct(array $attributes = array()) {
        $this->setRawAttributes(array(
            'storyline_id' => self::$holdCurrentStoryLineId
        ), true);
        parent::__construct($attributes);
    }

    public function storyline() {
        return $this->belongsTo(Storyline::class, 'storyline_id', 'id');
    }

    public static function currentStoryLine($storyline_id) {
        self::$holdCurrentStoryLineId = $storyline_id;
    }

    public function content() {
        //return $this->hasMany(Storyline::class, 'course_id', 'id');
        return $this->belongsTo('EONConsulting\ContentBuilder\Models\Content')->withTimestamps();
    }

    protected $parentColumn = 'parent_id';
    protected $leftColumn = '_lft';
    protected $rightColumn = '_rgt';
    protected $depthColumn = 'level';

    protected $guarded = array('id','_lft', '_rgt', 'nesting');





}
