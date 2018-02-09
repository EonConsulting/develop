<?php

namespace EONConsulting\Notifications\Models;

use Illuminate\Database\Eloquent\Model;

class SupportMessages extends Model {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'support_messages';

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
        'sender_id', 'subject', 'message'
    ];

}
