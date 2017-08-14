<?php namespace Unisa\Storymenu\Models;

use Model;

/**
 * Model
 */
class Storymenu extends Model
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
    public $table = 'unisa_storymenu_menu';

    protected $fillable = ['story_id', 'menu_title', 'page_url', 'description', 'user_id'];
}