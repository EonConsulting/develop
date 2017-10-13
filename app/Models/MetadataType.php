<?php
/**
 * Created by PhpStorm.
 * User: Reginald Bossman
 * Date: 2017/10/12
 * Time: 4:41 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetadataType extends Model {

    protected $table = 'metadata_types';
    protected $primaryKey = 'id';
    protected $fillable = ['name','description'];

    
}