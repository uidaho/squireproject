<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectFollower extends Model
{
    protected $fillable = ['user_id', 'project_id'];             //Set what can be mass assigned

    //Lets Laravel know the comment belongs to a project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    //Lets Laravel know the comment belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
