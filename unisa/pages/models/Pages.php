<?php namespace Unisa\Pages\Models;

use Model;

/**
 * Model
 */
class Pages extends Model
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

    public $belongsToMany = [
        'assets'=>[
            'Unisa\Assets\Models\Assets',
            'table'=>'unisa_pages_page_assets',
            'order'=>'asset_name'
        ]
    ];
}