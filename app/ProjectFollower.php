<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectFollower
 *
 * Defines the model for the project followers table. Provides helper
 * functions for accessing and handling project follower information.
 *
 * @author Robert Breckenridge (original)
 *
 * @package App
 */
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
