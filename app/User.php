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

    //Lets Laravel know the user has many comments
    public function comments()
    {
        return $this->hasMany(ProjectComment::class);
    }

    //Lets Laravel know the user has many projects
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    //Lets Laravel know the user has many projects
    public function projectMemberships()
    {
        return $this->hasMany(ProjectMember::class);
    }

    //Lets Laravel know the user has many projects
    public function projectRequests()
    {
        return $this->hasMany(ProjectRequest::class);
    }

    //Lets Laravel know the user has many projects
    public function projectFollows()
    {
        return $this->hasMany(ProjectFollower::class);
    }

    /**
     * Deletes everything connected to this user
     *
     * @param
     * @return
     */
    public function deleteUser()
    {
        $this->comments()->delete();
        $this->projectMemberships()->delete();
        $this->projectRequests()->delete();
        $this->projectFollows()->delete();

        //$this->profile()->delete();
        //$this->projects()->delete();
        $this->delete();
    }
}
