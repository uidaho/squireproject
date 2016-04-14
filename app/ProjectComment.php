<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectComment extends Model
{
    protected $table = 'projectComments';               //Set table name
    protected $fillable = ['body'];                     //Set what can be mass assigned

    //Lets Laravel know comments belong to a project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
