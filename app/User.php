<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'email', 'password',];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token',];

    /**
     * Get all comments by this user
     *
     * @return comments
     */
    public function comments()
    {
        return $this->hasMany(ProjectComment::class);
    }

    /**
     * Get all projects created by this user
     *
     * @return projects
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Get all memberships to projects by this user
     *
     * @return members
     */
    public function projectMemberships()
    {
        return $this->hasMany(ProjectMember::class);
    }

    /**
     * Get the membership requests by this user
     *
     * @return requests
     */
    public function projectRequests()
    {
        return $this->hasMany(ProjectRequest::class);
    }

    /**
     * Get all follows by this user
     *
     * @return followers
     */
    public function projectFollows()
    {
        return $this->hasMany(ProjectFollower::class);
    }

    /**
     * Deletes everything connected to this user
     *
     */
    public function deleteUser()
    {
        $this->comments()->delete();
        $this->projectMemberships()->delete();
        $this->projectRequests()->delete();
        $this->projectFollows()->delete();

        //$this->profile()->delete();
        $this->projects()->delete();
        $this->delete();
    }

	public function profile()
	{
		return $this->hasOne(Profile::class);
	}
}
