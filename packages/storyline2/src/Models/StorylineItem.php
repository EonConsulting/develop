<?php

namespace EONConsulting\Storyline2\Models;

use Illuminate\Database\Eloquent\Model;
use Baum\Node;
use EONConsulting\ContentBuilder\Models\Content;
use EONConsulting\ContentBuilder\Models\StorylineItemType;
use EONConsulting\Exports\Models\Traits\Exportable;
use EONConsulting\Exports\Models\TaoResult;

class StorylineItem extends Node {
    //Enable Nested Sets//
    //use NodeTrait;

    use Exportable;

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
        'parent_id', 'storyline_id', 'root_parent', 'level', 'name', 'description', 'file_name', 'file_url','content_id','type'
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id','_lft', '_rgt', 'nesting'
    ];

    /**
     * Columns which restrict what we consider our Nested Set list
     *
     * @var array
     */
    protected $scoped = [
        'storyline_id'
    ];

    /**
     * Column name to store the reference to parent's node.
     *
     * @var string
     */
    protected $parentColumn = 'parent_id';

    /**
     * Column name for left index.
     *
     * @var string
     */
    protected $leftColumn = '_lft';

    /**
     * Column name for right index.
     *
     * @var string
     */
    protected $rightColumn = '_rgt';

    /**
     * Column name for depth field.
     *
     * @var string
     */
    protected $depthColumn = 'level';

    protected static $holdCurrentStoryLineId;

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

    /**
     * Fetch storyline items for this model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function type()
    {
        return $this->hasOne(StorylineItemType::class, 'type');
    }

    /**
     * Fetch tao results for this model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function tao_results()
    {
        return $this->hasMany(TaoResult::class, 'storyline_item_id', 'id');
    }

    /*
     * Helper scope to get a storyline by searching for tao results between dates
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Carbon\Carbon $from_date
     * * @param \Carbon\Carbon $to_date
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopebyTaoResults($query, $from_date, $to_date)
    {
        return $query->whereHas('tao_results', function ($query) use ($from_date, $to_date) {
            $query->whereBetween('created_at', [$from_date, $to_date]);
        })->with('tao_results');
    }

    /*
     * Helper scope to get a storyline by just providing the storyline item
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $storyline_id
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopebyStoryline($query, $storyline_id)
    {
        return $query->where('storyline_id', $storyline_id);
    }
    
}
