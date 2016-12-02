<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/12/01
 * Time: 10:03 PM
 */

namespace EONConsulting\PHPSaasWrapper\Models;


use Illuminate\Database\Eloquent\Model;

class ServiceLinked extends Model {

    public $incrementing = true;
    protected $table = 'psw_services_linked';
    protected $primaryKey = 'service_link_id';
    protected $fillable = ['service_id', 'token', 'active'];
    protected $hidden = ['created_at', 'updated_at'];

}