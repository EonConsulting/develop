<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetadataStore extends Model {

    protected $table = 'metadata_store';
    protected $primaryKey = 'id';
    protected $fillable = ['id','metadata_type_id', 'description', 'classification', 'sequence'];
    
    
    public function metadata_type() {
        return $this->belongsTo(MetadataType::class, 'metadata_type_id', 'id');
    }

}
