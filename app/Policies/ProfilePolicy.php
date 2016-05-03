<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the user is the owner of this profile
     *
     * @param  User  $user
     * @return bool
     */
    public function userIsOwner(User $user, Profile $profile)
    {
        return $user->id == $profile->user_id;
    }
}
