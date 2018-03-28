<?php

namespace EONConsulting\ContentBuilder\Models;

use Illuminate\Database\Eloquent\Model;
use EONConsulting\ContentBuilder\Models\Content;

class Category extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lk_content_categories';

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
        'id','name', 'tags'
    ];

    /**
     * Fetch the content for this model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function content()
    {
        return $this->belongsToMany(Content::class, 'content_categories');
    }

}
