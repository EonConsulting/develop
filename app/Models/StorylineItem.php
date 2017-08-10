<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
Use Baum\Node;
class StorylineItem extends Node {
    //Enable Nested Sets//
    //use NodeTrait;

    protected $table = 'storyline_items';
    protected $primaryKey = 'id';
    protected $fillable = ['parent_id', 'storyline_id', 'level', 'name', 'description', 'file_name', 'file_url'];
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

    //Forget Parent and Children Foreign Keys
    //Node Belongs to Parent
//    public function parent() {
//        return $this->belongsTo(StorylineItem::class, 'parent_id', 'id');
//    }
//
//    //Node has Many Children
//    public function children() {
//        return $this->hasMany(StorylineItem::class, 'id', 'parent_id');
//    }

    public function storyline() {
        return $this->belongsTo(Storyline::class, 'storyline_id', 'id');
    }

    public static function currentStoryLine($storyline_id) {
        self::$holdCurrentStoryLineId = $storyline_id;
    }

    protected $parentColumn = 'parent_id';
    protected $leftColumn = '_lft';
    protected $rightColumn = '_rgt';
    protected $depthColumn = 'level';
//  //Guard From Mass Assignments
    protected $guarded = array('id','_lft', '_rgt', 'nesting');

    protected $orderColumn = 'level';




}