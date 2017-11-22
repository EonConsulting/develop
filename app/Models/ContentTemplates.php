<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 2017/11/17
 * Time: 11:03 AM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentTemplates extends Model
{

    protected $table = 'content_templates';
    protected $primaryKey = 'id';
    protected $fillable = ['name','file_path'];
}
