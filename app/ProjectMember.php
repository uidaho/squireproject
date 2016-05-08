<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectMember
 *
 * Defines the model for the project members table. Provides helper
 * functions for accessing and handling project member information.
 *
 * @author Robert Breckenridge (original)
 * @author Rick Boss (editor)
 *
 * @package App
 */
class ProjectMember extends Model
{
    protected $table = 'project_members';                                       //Set table name
    protected $fillable = ['user_id', 'project_id', 'admin'];                   //Set what can be mass assigned

    /**
     * Get the project for this membership
     *
     *
     * @return project
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the user for this membership
     *
     *
     * @return user
     */
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

    /**
     * Helper function to build min/max requirements array.
     *
     * @param int $min
     * @param int $max
     * @return array
     */
    private static function minMaxHelper($min, $max) {
        return [
            'min' => $min,
            'max' => $max
        ];
    }

    /**
     * Check if user is a admin of this project
     *
     * @return boolean
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
