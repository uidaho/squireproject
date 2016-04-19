<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Project;
use App\ProjectComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProjectCommentsController extends Controller
{
    /**
     * Adds the comment to the given project
     *
     * @param $request = user entered text, $project data
     * @return back to same page
     */
    public function addComment(CreateCommentRequest $request, Project $project)
    {
        if(Auth::guest())                                                                   //Checks if user is not logged in
        {
            Session::flash('guestComment', 'You must be logged in to submit a comment');
        }
        else                                                                                //User is logged in
        {
            $project->addComment(
                new ProjectComment($request->all())
            );
            Session::flash('userComment', 'Comment submitted');
        }
        return back();
    }
}