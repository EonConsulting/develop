<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LtiUser extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lti_user';

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
        'user_id', 'user_key', 'email', 'displayname'
    ];

    /*
     * Get the Storyline ID Associated with Story
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */

    
}
