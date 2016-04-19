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

    /**
     * Destroy the given project comment
     *
     * @param  Request  $request
     * @param $request = user entered data, $comment data
     * @return back to same page
     */
    public function deleteComment(Request $request, Project $project, ProjectComment $projectComment)
    {
        $this->authorize('destroy', $projectComment);
        $projectComment->delete();
        return back();
    }

    /**
     * Goes to a page to edit the given project comment
     *
     * @param  Request  $request
     * @param $request = user entered data, $comment data
     * @return to edit comment page
     */
    public function editComment(Request $request, Project $project, ProjectComment $projectComment)
    {
        $this->authorize('destroy', $projectComment);
        return view('project.editcomment', ['project' => $project, 'comment' => $projectComment]);
    }
    /**
     * Updates the comment for the given project
     *
     * @param $request = user entered text, $project data
     * @return back to same page
     */
    public function updateComment(CreateCommentRequest $request, Project $project, ProjectComment $projectComment)
    {
        $this->authorize('destroy', $projectComment);

        $projectComment->update($request->all());

        Session::flash('userComment', 'Comment updated');
        $project->load('comments.user');
        return view('project.view', ['project' => $project]);
    }
}