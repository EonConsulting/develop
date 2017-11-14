<?php
/**
 * Created by PhpStorm.
 * User: Reginald Bossman
 * Date: 2017/10/12
 * Time: 4:41 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetadataType extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'metadata_types';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name','description'
    ];
}
