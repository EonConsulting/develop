<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Baum\Node;

class StorylineItem extends Node
{
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
        'parent_id', 'storyline_id', 'level', 'name', 'description', 'file_name', 'file_url'
    ];

    //Set Scope for Storyline Construction
    protected $scoped = [
        'storyline_id'
    ];

    protected static $holdCurrentStoryLineId;

    /**
     * @var string
     */
    protected $parentColumn = 'parent_id';

    /**
     * @var string
     */
    protected $leftColumn = '_lft';

    /**
     * @var string
     */
    protected $rightColumn = '_rgt';

    /**
     * @var string
     */
    protected $depthColumn = 'level';
    //  //Guard From Mass Assignments

    /**
     * @var array
     */
    protected $guarded = [
        'id','_lft', '_rgt', 'nesting'
    ];

    /**
     * @var string
     */
    protected $orderColumn = 'level';

    //Set Attribute Mutation
    public function __construct(array $attributes = [])
    {
        $this->setRawAttributes([
            'storyline_id' => self::$holdCurrentStoryLineId
        ], true);

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

    /**
     * Fetch the storyline for this item.
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
    
   

}
