<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetRegister extends Model
{

  /**
   * Table name.
   *
   * @var string
   */
    protected $table = 'asset_register';
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
        'course_id', 'storyline_id', 'video_count', 'video_register', 'ebook_count',
        'ebook_register'
    ];
}
