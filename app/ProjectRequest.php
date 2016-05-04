<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectRequest extends Model
{
    protected $table = 'project_requests';                          //Set table name
    protected $fillable = ['user_id', 'project_id'];                //Set what can be mass assigned

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

    //Todo user defined timezone
    public function getCreatedAt()
    {
        $time = Carbon::createFromTimestamp(strtotime($this->created_at))->timezone('America/Los_Angeles');

        return $time->format('F j\\, Y \\a\\t g:i A');
    }

    public function getUpdatedAt()
    {
        $time = Carbon::createFromTimestamp(strtotime($this->updated_at))->timezone('America/Los_Angeles');

        return $time->format('F j\\, Y \\a\\t g:i A');
    }
}
