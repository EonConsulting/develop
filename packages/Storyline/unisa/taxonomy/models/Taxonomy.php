<?php namespace Unisa\Taxonomy\Models;

use Model;

/**
 * Model
 */
class Taxonomy extends Model
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
    public $table = 'unisa_taxonomy_taxonomy';

    protected $fillable = ['taxonomy_name', 'description', 'user_id'];

    public $belongsToMany = [
        'stories'=>[
            'Unisa\Storycore\Models\Storycore',
            'table'=>'unisa_taxonomy_taxo_stories',
            'order'=>'story_name'
        ]
    ];
}