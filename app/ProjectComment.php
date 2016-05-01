<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ProjectComment extends Model
{
    protected $table = 'project_comments';               //Set table name
    protected $fillable = ['comment_body'];             //Set what can be mass assigned

    /**
     * Get project for this comment
     *
     *
     * @return project
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get user for this comment
     *
     *
     * @return user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get created at timestamp for this comment
     *
     *
     * @return timestamp
     */
    public function getCreatedAt()
    {
        $time = Carbon::createFromTimestamp(strtotime($this->created_at))->timezone('America/Los_Angeles');

        return $time->format('F j\\, Y \\a\\t g:i A');
    }

    /**
     * Get updated at timestamp for this comment
     *
     *
     * @return timestamp
     */
    public function getUpdatedAt()
    {
        $time = Carbon::createFromTimestamp(strtotime($this->updated_at))->timezone('America/Los_Angeles');

        return $time->format('F j\\, Y \\a\\t g:i A');
    }
}
