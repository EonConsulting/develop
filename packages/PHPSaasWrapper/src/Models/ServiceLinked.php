<?php

namespace EONConsulting\PHPSaasWrapper\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class ServiceLinked (Model)
 * @package EONConsulting\PHPSaasWrapper\Models
 */
class ServiceLinked extends Model {

    public $incrementing = true;
    protected $table = 'psw_services_linked';
    protected $primaryKey = 'service_link_id';
    protected $fillable = ['service_id', 'token', 'active'];
    protected $hidden = ['created_at', 'updated_at'];

}