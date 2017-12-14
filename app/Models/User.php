<?php

namespace App\Models;

use EONConsulting\LaravelLTI\Models\UserLTILink;
use EONConsulting\RolesPermissions\Traits\HasPermissionTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use EONConsulting\Storyline2\Models\Course;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, HasPermissionTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Fetch the user lti.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function lti()
    {
        return $this->hasMany(UserLTILink::class, 'user_id', 'id');
    }

    /**
     * @param $user_id
     * @return bool
     */
    public function hasLtiLink($user_id)
    {
        return (bool) $this->lti->where('lti_user_id', $user_id)->count();
    }

    /**
     * @param $user_id
     * @return mixed
     */
    public function hasLtiLinks($user_id)
    {
        return $this->lti->where('lti_user_id', $user_id);
    }

    /**
     * @param $context_id
     * @return mixed
     */
    public function hasLtiContext($context_id)
    {
        return $this->lti->where('context_id', $context_id);
    }

    /**
     * Fetch course users for this model
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'integrate_course_users', 'user_id', 'course_id');
    }

    /**
     * Check if user has role
     *
     * @param string $role
     * @return bool
     */
    public function hasRole($role = 'Administrator')
    {
        if ( ! $lti = $this->lti->first()) {
            return false;
        }

        if($lti->roles == $role) {
            return true;
        }

        return false;
    }

    /**
     * Route notifications for the Nexmo channel.
     *
     * @return string
     */
    public function routeNotificationForNexmo()
    {
        return $this->mobile_number;
    }

    /**
     * Get the user's first name.
     *
     * @return string
     */
    public function getFirstNameAttribute()
    {
        $fullname = explode(" ", $this->name);
        return $fullname[0] ?? '';
    }

    /**
     * Get the user's last name.
     *
     * @return string
     */
    public function getLastNameAttribute()
    {
        $fullname = explode(" ", $this->name);
        return $fullname[1] ?? '';
    }

    /**
     * Get the user's LTI role.
     *
     * @return string
     */
    public function getLtiRoleAttribute()
    {
        if ( ! $lti = $this->lti->first())
        {
            return false;
        }

        return $lti->roles;
    }
}
