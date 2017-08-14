<?php namespace Unisa\Storycore\Models;

use Model;

/**
 * Model
 */
class Storycore extends Model
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
    public $table = 'unisa_storycore_storylines';

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['id','story_name','description','user_id'];

    public $belongsToMany = [
        'pages'=>[
            'Unisa\Pages\Models\Page',
            'table'=>'unisa_storycore_story_pages',
            'order'=>'page_name'
        ],
        'taxonomies'=>[
            'Unisa\Taxonomy\Models\Taxonomy',
            'table'=>'unisa_taxonomy_taxo_stories',
            'order'=>'story_name'
        ]
    ];
}