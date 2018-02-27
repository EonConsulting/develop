<?php

namespace EONConsulting\Storyline2\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Template extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'templates';

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
        'name','styles','creator_id'
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


}
