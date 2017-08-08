<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 9:36 AM
 */

namespace EONConsulting\PHPStencil\src\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyTable
 * @package EONConsulting\PHPStencil\src\Models
 */
class DummyTable extends Model {

    public $incrementing = true;
    protected $table = 'dummy_table';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'body', 'slug'];

}