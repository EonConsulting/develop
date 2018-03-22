<?php

namespace EONConsulting\ContentBuilder\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\User;
use EONConsulting\ContentBuilder\Models\Category;
use EONConsulting\Storyline2\Models\StorylineItem;

class Content extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'content';

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
        'title', 'body', 'tags', 'creator_id','description','cloned_id'
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
     * Fetch the categories for this model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'content_categories')->withTimestamps();
    }

    /**
     * Fetch storyline items for this model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function storyline_items()
    {
        return $this->hasMany(StorylineItem::class, 'content_id');
    }

    /**
     * Fetch storyline item for this model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function storyline_item()
    {
        return $this->hasOne(StorylineItem::class, 'content_id');
    }

}
