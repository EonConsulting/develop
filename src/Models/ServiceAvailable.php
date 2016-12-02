<?php

namespace EONConsulting\PHPSaasWrapper\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/12/01
 * Time: 10:01 PM
 */
class ServiceAvailable extends Model {

    public $incrementing = true;
    protected $table = 'psw_services_available';
    protected $primaryKey = 'service_id';
    protected $fillable = ['service_name', 'service_key'];
    protected $hidden = ['created_at', 'updated_at'];

}