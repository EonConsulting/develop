<?php

namespace App\Models\Traits;

use App\Models\ContentLocking;
use Auth;

trait Lockable
{

    /**
     * Boot the trait.
     */
    protected static function bootLockable()
    {
        static::deleting(function ($model) {
            $model->content_lock->each->delete();
        });
    }

    /**
     * A model can be locked.
     *
     * @return \Illuminate\Database\Eloquent\Relations\morphMany
     */
    public function content_lock()
    {
        return $this->morphOne(ContentLocking::class, 'lockable');
    }

    /**
     * Determine if the current model is locked.
     *
     * @return boolean
     */
    public function isLocked() : bool
    {
        return count($this->content_lock) != 0;
    }

    /**
     * Determine if the current model is locked and can be edited.
     *
     * @return bool
     */
    public function isEditable() : bool
    {
        if( ! $this->isLocked())
        {
            return true;
        }

        return $this->isLocked() && $this->creator_id == Auth::user()->id;
    }

    /**
     * Check if the user may lock this model
     *
     * @return bool
     */
    public function canBeLocked() : bool
    {
        return $this->creator_id == Auth::user()->id;
    }

    /**
     * Lock the current model
     *
     * @return Model
     */
    public function lock()
    {
        if( ! $this->canBeLocked())
        {
            return false;
        }

        if ( ! $this->isLocked())
        {
            $this->content_lock()->create([
                'user_id' => Auth::user()->id
            ]);

            return true;
        }

        return false;
    }

    /**
     * Unlock the current model.
     */
    public function unlock()
    {
        if($this->content_lock()->first()->user_id != Auth::user()->id)
        {
            return false;
        }

        if($this->content_lock()->delete())
        {
            return true;
        }
    }

}