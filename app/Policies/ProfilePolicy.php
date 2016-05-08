<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class ProfilePolicy
 *
 * Policies for the profile class
 *
 * @author Robert Breckenridge (original)
 *
 * @package App\Policies
 */
class ProfilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the user is the owner of this profile
     *
     * @param User $user
     * @param Profile $profile
     * @return bool
     */
    public function userIsOwner(User $user, Profile $profile)
    {
        return $user->id == $profile->user_id;
    }
}
