<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/02/15
 * Time: 10:21 AM
 */

namespace EONConsulting\LaravelLTI\Models;


use EONConsulting\AppStore\Models\AppCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class LTIDomain extends Model {

    protected $table = 'lti_domain';
    protected $fillable = [
        'key_id', 'context_id', 'domain', 'port', 'consumer_key', 'secret', 'json', 'logo_uri'
    ];

    public function context() {
        return $this->hasOne(LTIContext::class, 'context_id', 'context_id');
    }

    public function key() {
        return $this->hasOne(LTIKey::class, 'key_id', 'key_id');
    }

    public function meta() {
        return $this->hasMany(LTIDomainMeta::class, 'context_id', 'content_');
    }

    public function category() {
        return $this->belongsTo(AppCategory::class, 'category_id');
    }

}