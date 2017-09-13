<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetadataStore extends Model {

    protected $table = 'metadata_store';
    protected $primaryKey = 'id';
    protected $fillable = ['metadata_type', 'description', 'classification', 'sequence'];

}
