<?php namespace Unisa\Assets\Models;

use Model;

/**
 * Model
 */
class Asset extends Model
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
    public $table = 'unisa_assets_assets';
    protected $fillable = ['asset_name', 'file_name', 'user_id', 'content', 'is_published'];

    public $belongsToMany = [
        'pages'=>[
            'Unisa\Pages\Models\Page',
            'table'=>'unisa_pages_page_assets',
            'order'=>'asset_name'
        ]
    ];
}