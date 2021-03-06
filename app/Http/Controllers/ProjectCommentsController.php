<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Project;
use App\ProjectComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

/**
 * Class ProjectCommentsController
 *
 * The controller responsible for handling all incoming
 * project comments related requests.
 *
 * @author Robert Breckenridge (original)
 * @author Brandon Jank (editor)
 *
 * @package App\Http\Controllers
 */
class ProjectCommentsController extends Controller
{
    /**
     * Adds the comment to the given project
     *
     * @param $request = user entered text, $project data
     * @return view Back to same page
     */
    public function addComment(CreateCommentRequest $request, Project $project)
    {
        $project->addComment(new ProjectComment($request->all()));
        Session::flash('comment_success', 'Comment submitted');

        return back();
    }

    /**
     * Destroy the given project comment
     *
     * @param $request = user entered data, $projectComment = data
     * @return view Back to same page
     */
    public function deleteComment(Request $request, ProjectComment $projectComment)
    {
        $this->authorize('userIsOwner', $projectComment);
        $projectComment->delete();
        Session::flash('comment_success', 'Comment deleted');

        return back();
    }

    /**
     * Goes to a page to edit the given project comment
     *
     * @param $projectComment = data
     * @return view Edit comment page
     */
    public function editComment(ProjectComment $projectComment)
    {
        $this->authorize('userIsOwner', $projectComment);

        return view('project.editcomment', ['comment' => $projectComment]);
    }

    /**
     * Updates the comment for the given project
     *
     * @param $request = user entered text, $projectComment = data
     * @return view Back to the same page
     */
    public function updateComment(CreateCommentRequest $request, ProjectComment $projectComment)
    {
        $this->authorize('userIsOwner', $projectComment);

        $projectComment->update($request->all());
        $projectPath = 'project/' . $projectComment->project->title;

        return redirect($projectPath);
    }
}

