<?php

namespace EONConsulting\Messages\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Notifications\DatabaseNotification;
use App\Models\User;

class DatabaseNotificationPolicy
{
    use HandlesAuthorization;

    public function view(User $user, DatabaseNotification $message)
    {
        return $message->notifiable_id == $user->id;
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function delete(User $user, DatabaseNotification $message)
    {
        return $message->notifiable_id == $user->id;
    }
}