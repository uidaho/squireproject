<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectComment extends Model
{
    protected $table = 'projectComments';               //Set table name
    protected $fillable = ['comment_body'];             //Set what can be mass assigned
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