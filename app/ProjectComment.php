<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectComment extends Model
{
    protected $table = 'projectComments';
    protected $fillable = ['body'];

    //Lets Laravel know comments belong to a project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
