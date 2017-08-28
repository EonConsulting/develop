<?php

namespace EONConsulting\CKEditorPlugin\Models;

use Illuminate\Database\Eloquent\Model;


class LtiCkDomain extends Model
{
    protected $table = 'lti_ck_domains';
    protected $primaryKey = 'id';
    protected $fillable = ['launch_url', 'key', 'secret'];
}
