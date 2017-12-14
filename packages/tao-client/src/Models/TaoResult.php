<?php

namespace EONConsulting\TaoClient\Models;

use Illuminate\Database\Eloquent\Model;
use EONConsulting\Storyline2\Models\StorylineItem;
use App\Models\User;
use EONConsulting\TaoClient\Models\Tao\ResultIdentifiers;
use EONConsulting\TaoClient\Models\Tao\ResultsStorage;
use EONConsulting\TaoClient\Models\TaoAssessment;
use Carbon\Carbon;

class TaoResult extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'integrate_tao_results';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'response' => 'array',
    ];

    /**
     * Get user related to this model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    /**
     * Get storyline item related to this model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function storyline_item()
    {
        return $this->belongsTo(StorylineItem::class, 'id', 'storyline_item_id');
    }

    /**
     * Get result identifier from tao's database
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function result_identifier()
    {
        return $this->hasOne(ResultIdentifiers::class, 'result_id', 'lis_result_sourcedid');
    }

    /**
     * Scope a query to only include results with source id.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopebySourceId($query, $source_id)
    {
        return $query->where('lis_result_sourcedid', $source_id);
    }

    /**
     * Scope a query to only include pending outcomes.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopebyPendingOutcome($query)
    {
        return $query->where('status', 0)
                     ->whereNull('score')
                     ->whereNotNull('storyline_item_id');
    }

    /**
     * Scope a query to only include pending api.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopebyPendingApi($query)
    {
        return $query->where('status', 1)
                     ->whereNull('response')
                     ->whereNotNull('storyline_item_id');
    }

    /**
     * Scope a query to only include pending api.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopebyFailed($query)
    {
        $query->where('status', 3)
              ->whereNull('response');
    }

    /**
     * Scope a query to only include incomplete.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopebyIncomplete($query)
    {
        $date = Carbon::now()->subDay(1);

        return $query->where('status', 0)
                     ->where('created_at', '<', $date);
    }
}