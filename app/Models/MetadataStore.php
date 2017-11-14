<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetadataStore extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'metadata_store';

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
        'id','metadata_type_id', 'description', 'classification', 'sequence'
    ];

    /**
     * Fetch the metadata type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function metadata_type()
    {
        return $this->belongsTo(MetadataType::class, 'metadata_type_id', 'id');
    }

    /**
     * Fetch the course metadate.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function course_metadata()
    {
        return $this->hasOne(CourseMetadata::class, 'metadata_store_id', 'id');
    }
}
