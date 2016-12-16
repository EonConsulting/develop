<?php namespace Unisa\Ltiobject\Models;

use Model;

/**
 * Model
 */
class Ltiobject extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /*
     * Validation
     */
    public $rules = [
    ];

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    /**
     * Fillable fields 
     * @var array
     */
    protected $fillable = ['id','object_name', 'description', 'user_id', 'launcher_url', 'endpoint_url', 'key', 'secret'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'unisa_ltiobject_lti';

    public $belongsToMany = [
        'pages'=>[
            'Unisa\Pages\Models\Pages',
            'table'=>'unisa_pages_page_lti',
            'order'=>'object_name'
        ]
    ];

    
}