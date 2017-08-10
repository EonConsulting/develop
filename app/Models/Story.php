<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Baum\Node;

/**
* Story
*/
class Story extends Node {

    protected $table = 'stories';
    protected $primaryKey = 'id';
    protected $fillable = [ 'storyline_id','title','description', 'file_name', 'file_url'];

    /*
     * Get the Storyline ID Associated with Story
     */

    public function storyline() {
        return $this->belongsTo(Storyline::class, 'storyline_id', 'id');
    }

    //Forget Parent and Children Foreign Keys
    public function parent() {
        return $this->belongsTo(StorylineItem::class, 'parent_id', 'id');
    }

    public function children() {
        return $this->hasMany(StorylineItem::class, 'id', 'parent_id');
    }
}
