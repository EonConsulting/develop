<?php

namespace App\Models;

use EONConsulting\LaravelLTI\Models\UserLTILink;
use EONConsulting\RolesPermissions\Traits\HasPermissionTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, HasPermissionTrait;

    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function lti() {
        return $this->hasMany(UserLTILink::class, 'user_id', 'id');
    }

    public function hasLtiLink($user_id) {
        return (bool) $this->lti->where('lti_user_id', $user_id)->count();
    }

    public function hasLtiLinks($user_id) {
        return $this->lti->where('lti_user_id', $user_id);
    }

    public function hasLtiContext($context_id) {
        return $this->lti->where('context_id', $context_id);
    }

}
