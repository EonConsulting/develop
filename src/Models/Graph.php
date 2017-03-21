<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 9:36 AM
 */

namespace EONConsulting\Graphs\src\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyTable
 * @package EONConsulting\PHPStencil\src\Models
 */
class Graph extends Model {

    public $incrementing = true;
    protected $table = 'lti_graphs';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'code', 'name'];

}