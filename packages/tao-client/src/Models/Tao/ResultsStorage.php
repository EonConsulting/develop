<?php

namespace EONConsulting\TaoClient\Models\Tao;

use Illuminate\Database\Eloquent\Model;

class ResultsStorage extends Model
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
    protected $table = 'results_storage';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}