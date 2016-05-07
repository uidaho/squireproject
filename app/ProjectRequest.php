<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectRequest
 *
 * Defines the model for the project requests table. Provides helper
 * functions for accessing and handling project request information.
 *
 * @author Robert Breckenridge (original)
 *
 * @package App
 */
class ProjectRequest extends Model
{
    protected $table = 'project_requests';                          //Set table name
    protected $fillable = ['user_id', 'project_id'];                //Set what can be mass assigned

    /**
     * Get the project for this request
     *
     *
     * @return project
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the user for this request
     *
     *
     * @return user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
