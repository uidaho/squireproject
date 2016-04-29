<?php

namespace App\Policies;

use App\ProjectMember;
use App\User;
use App\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectMembersPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user is an admin of the project
     *
     * @param  User $user
     * @param  Project $project
     * @return bool
     */
    public function userIsAdmin(User $user, Project $project)
    {
        return $project->isProjectAdmin($user->id);
    }

    /**
     * Determine if the given user is the owner of the given project
     *
     * @param  User $user
     * @param  Project $project
     * @return bool
     */
    public function userIsOwner(User $user, Project $project)
    {
        return $project->isUserAuthor($user);
    }

    /**
     * Determine if the given user is a member of the given project
     *
     * @param  User $user
     * @param  Project $project
     * @return bool
     */
    public function userIsMember(User $user, Project $project)
    {
        return $project->isUserMember($user->id);
    }

    /**
     * Determine if the given user has appropriate privileges to kick a user from a project
     * Checks if user is a admin for the project and the user to be kicked is not a admin or the project owner
     *
     * @param  User $user
     * @param  Project $project
     * @param  ProjectMember $member
     * @return bool
     */
    public function authToKick(User $user, Project $project, ProjectMember $member)
    {
        return $project->isUserAuthor($user) || ($project->isProjectAdmin($user->id) && !$project->isProjectAdmin($member->user->id) && !$project->isUserAuthor($member->user));
    }
}
