<?php

namespace EONConsulting\TaoClient\Models\Tao;

use Illuminate\Database\Eloquent\Model;
use EONConsulting\TaoClient\Models\Tao\ResultsStorage;

class ResultIdentifiers extends Model
{

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'taodb';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lti_result_identifiers';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get a result storage entry for this model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function result_storage()
    {
        return $this->hasOne(ResultsStorage::class, 'result_id', 'delivery_execution_id');
    }

    /**
     * Scope a query to only include results by reference.
     *
     * @param string $reference
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByReference($query, $reference)
    {
        return $query->where('result_id', $reference);
    }
}