<?php

namespace EONConsulting\Exports\Models;

use Illuminate\Database\Eloquent\Model;
use EONConsulting\Storyline2\Models\StorylineItem;
use App\Models\User;

class TaoResult extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'integrate_tao_results';

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'user'
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get user related to this model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get storyline item related to this model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function storyline_item()
    {
        return $this->belongsTo(StorylineItem::class, 'storyline_item_id', 'id');
    }

}