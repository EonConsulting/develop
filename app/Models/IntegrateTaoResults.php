<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntegrateTaoResults extends Model
{

  /**
   * Table name.
   *
   * @var string
   */
    protected $table = 'integrate_tao_results';
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
        'user_id', 'storyline_item_id', 'list_result_sourcedid', 'delivery_execution_id', 
        'test_taker', 'score', 'ingested', 'response', 'status', 'status_message'
    ];
}
