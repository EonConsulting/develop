<?php

namespace EONConsulting\StudentNotes\Models;

use Illuminate\Database\Eloquent\Model;
use EONConsulting\Storyline2\Models\StorylineItem;
use App\Models\User;

class Note extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'student_notes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'storyline_item_id', 'body'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function scopebyStudent($query)
    {
        $user_id = '1'; // auth()->user()->id @TODO

        return $query->where('user_id', $user_id);
    }

    public function scopeforStoryLineItem($query, $storyline_item_id)
    {
        return $query->where('storyline_item_id', $storyline_item_id);
    }
}
