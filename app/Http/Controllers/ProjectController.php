<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\DeleteProjectRequest;
use App\Http\Requests\CreateCommentRequest;
use App\Project;
use App\ProjectComment;
use App\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
	public function listProjects()
	{
		return view('project.list', ['projects' => Project::all()]);
	}
	
    /**
     * Renders the Project View for the given id
     *
     * @param Project $project
     * @return The project page view
     * @internal param Project $id id for lookup
     */
    public function view(Project $project)
    {
        $project->load('comments.user');

        return view('project.view', ['project' => $project]);
    }

    /**
     * Renders the project creation view if user is logged in
     *
     * @return mixed
     */
    public function createForm()
    {
        if (Auth::guest()) {
            return redirect('/login');
        }
        return view('project.create');
    }

    /**
     * Creates a new project using the input from the form
     *
     * @param CreateProjectRequest $request The validated request
     * @return mixed
     */
    public function create(CreateProjectRequest $request)
    {
        $newEntry = Project::create([
            'author' => Auth::user()->username,
            'title'  => $request->getTitle(),
            'description' => $request->getDescription(),
            'body' => $request->getBody()
        ]);

        $thumbnail = $request->file('thumbnail');
        $thumbnail->move(base_path() . '/public/images/projects',  'product' . $newEntry->id . '.jpg');

        return redirect($newEntry->getSlug());
    }

    /**
     * Deletes the project give by the id, only if the user
     * is authenticated and is the author.
     *
     * @param DeleteProjectRequest $request
     * @return mixed
     */
    public function delete(DeleteProjectRequest $request)
    {
        $project = $request->project;
        $title = $project->title;
        $project->delete();

        Session::flash('delete-success', 'Successfully deleted the project "' . $title .'"');
        return redirect()->action('ProjectController@listProjects');
    }

    /**
     * Adds the comment to the given project
     *
     * @param $request = user entered text, $project project_id for lookup
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
