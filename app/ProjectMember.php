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

    /**
     * Returns the array of lengths required for the attributes.
     *
     * @return array
     */
    public static function attributeLengths()
    {
        return [
            'statement-title' => ProjectMember::minMaxHelper(1, 20),
            'statement-body' => ProjectMember::minMaxHelper(1, 100),
            'tab-title' => ProjectMember::minMaxHelper(1, 20),
            'tab-body' => ProjectMember::minMaxHelper(1, 65000),
        ];
    }

    private static function minMaxHelper($min, $max) {
        return [
            'min' => $min,
            'max' => $max
        ];
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
