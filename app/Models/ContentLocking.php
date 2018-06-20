<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentLocking extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'content_locking';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Fetch the model that was locked.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function lockable()
    {
        return $this->morphTo();
    }

}