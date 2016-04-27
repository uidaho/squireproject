<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectMember extends Model
{
    protected $table = 'project_members';                           //Set table name
    protected $fillable = ['user_id', 'project_id', 'admin'];                //Set what can be mass assigned
    
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

    /**
     * Check if user is a follower of this project
     *
     * @return
     */
    public function isProjectAdmin($user_id = null)
    {
        if (!Auth::guest()) {
            if ($user_id == null)
                $user_id = Auth::user()->id;

            
            $isAdmin = ProjectMember::where('user_id', '=', $user_id)->where('project_id', '=', $this->id)->first();
            if ($isAdmin != null)
                $isAdmin = true;
            else
                $isAdmin = false;
        }
        else
            $isAdmin = false;

        return $isAdmin;
    }
}
