<?php
namespace App\Policies;

use App\User;
use App\ProjectComment;
use Log;
use Illuminate\Auth\Access\HandlesAuthorization;
class ProjectCommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user is the owner of the given project comment.
     *
     * @param  User  $user
     * @param  ProjectComment $projectComment
     * @return bool
     */
    public function userIsOwner(User $user, ProjectComment  $projectComment)
    {
        return $user->id == $projectComment->user_id;
    }
}
