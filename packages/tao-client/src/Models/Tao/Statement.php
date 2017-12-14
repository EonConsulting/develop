<?php

namespace EONConsulting\TaoClient\Models\Tao;

use Illuminate\Database\Eloquent\Model;

class Statement extends Model
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
    protected $table = 'statements';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Scope a query to only include delivery uris.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopebyDeliveryUri($query)
    {
        return $query->where('predicate', 'http://www.tao.lu/Ontologies/TAODelivery.rdf#AssembledDeliveryOrigin');
    }

    /**
     * Get the delivery uri.
     *
     * @return string
     */
    public function getDeliveryUriAttribute()
    {
        return $this->subject;
    }

}