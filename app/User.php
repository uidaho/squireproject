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
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //Lets Laravel know the user has many comments
    public function comments()
    {
        return $this->hasMany(ProjectComment::class);
    }

    //Lets Laravel know the user has many projects
    public function projects()
    {
        return $this->hasMany(Projects::class);
    }

    //Lets Laravel know the user has many projects
    public function projectsAsMember()
    {
        return $this->hasMany(Projects::class);
    }
}
