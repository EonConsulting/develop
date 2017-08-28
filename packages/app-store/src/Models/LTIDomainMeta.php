<?php
/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 7/25/2017
 * Time: 10:35 AM
 */
namespace EONConsulting\AppStore\Models;


use Illuminate\Database\Eloquent\Model;
use EONConsulting\LaravelLTI\Models\LTIDomain;

class LTIDomainMeta extends Model {

    protected $table = 'lti_users_domains_meta';
    protected $fillable = [
        'user_id', 'lti_user_id', 'app_id', 'lti_version', 'category', 'user_agent', 'display_type'
    ];

    public function domain() {
        return $this->belongsTo(LTIDomain::class, 'context_id', 'context_id');
    }

}