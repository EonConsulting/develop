<?php namespace Unisa\Pages\Models;

use Model;
use Db;
use BackendAuth;
/**
 * Model
 */
class Page extends Model
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
     * @var string The database table used by the model.
     */
    public $table = 'unisa_pages_pages';

    /**
     * Fillable fields 
     * @var array
     */
    protected $fillable = ['id','page_name', 'page_title', 'user_id', 'meta_keyword', 'meta_description', 'summary'];

    /**
     * Defines the many relation to the other tables
     * @var array
     */
    public $belongsToMany = [
        'assets'=>[
            'Unisa\Assets\Models\Asset',
            'table'=>'unisa_pages_page_assets',
            'order'=>'asset_name'
        ],
        'stories'=>[
            'Unisa\Storycore\Models\Storycore',
            'table'=>'unisa_storycore_story_pages',
            'order'=>'page_name'
        ],
        'ltiobject'=>[
            'Unisa\ltiobject\Models\Ltiobject',
            'table'=>'unisa_pages_page_lti',
            'order'=>'object_name'
        ]
    ];

    /**
     * image Relations
     */
    public $attachOne = [
        'image'=>'System\Models\File'
    ];

    public function getLtiboxOptions($keyValue = ''){
        return DB::table('unisa_ltiobject_lti')->lists('object_name', 'id');
    }
}