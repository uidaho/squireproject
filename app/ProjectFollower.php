<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectFollower extends Model
{
    protected $fillable = ['user_id', 'project_id'];             //Set what can be mass assigned

    /**
     * Get the project of this follower
     *
     * @return projects
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the user of this follower
     *
     * @return user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
