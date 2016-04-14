<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Project extends Model
{
    protected $fillable = [
        'title', 'author', 'description', 'body', 'created_at', 'updated_at'
    ];

    //Used for fetching the project's comments
    public function comments()
    {
        return $this->hasMany(ProjectComment::class);
    }

    //Adds a comment to the project
    public function addComment(ProjectComment $comment)
    {
        $comment->user_id = Auth::id();

        return $this->comments()->save($comment);
    }
}
