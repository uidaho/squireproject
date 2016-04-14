<?php

namespace App\Http\Controllers;

use App\Project;
use App\ProjectComment;
use App\Http\Requests\CreateCommentRequest;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class ProjectController extends Controller
{
    /**
     * Renders the Project View for the given id
     *
     * @param $project project id cast to Project
     * @return The project page view
     */
    public function view(Project $project)
    {
        $project->load('comments.user');

        return view('pages.project', compact('project'));
    }

    /**
     * Renders the project creation view if user is logged in
     *
     * @return mixed
     */
    public function createProjectPage()
    {
        if (Auth::guest()) {
            return redirect('/login');
        }
        return view('pages.create');
    }

    /**
     * Creates a new project using the input from the form
     *
     * @return mixed
     */
    public function create()
    {
        if (Auth::guest()) {
            return redirect('/login');
        }
        $title = Request::input('title');
        $description = Request::input('description');
        $body = Request::input('project-body');
        $newEntry = Project::create([
            'author' => Auth::user()->username,
            'title'  => $title,
            'description' => $description,
            'body' => $body
        ]);

        if (Request::hasFile('thumbnail')) {
            $path = str_replace('/app', '', app_path());
            $thumbnail = Request::file('thumbnail');
            $thumbnail->move($path . '/public/images/projects',  'product' . $newEntry->id . '.jpg');
        }

        return redirect('/project/' . $newEntry->id);
    }

    /**
     * Deletes the project give by the id, only if the user
     * is authenticated and is the author.
     *
     * @param $id the project id for lookup
     * @return mixed
     */
    public function delete($id)
    {
        if (Auth::guest()) {
            return redirect('/login');
        }

        $project = Project::find($id);
        if ($project == null) {
            // TODO: Redirect to an error page
            return redirect('/projectfinder');
        }

        if ($project->author == Auth::user()->username) {
            $project->delete();
            $imagePath = base_path() . '/public/images/projects/product' . $id . '.jpg';
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // TODO: Notice of success?
        return redirect('/projectfinder');
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
            /*$this->validate($request, [
                'comment_body' => 'required|min:6|max:256|regex:/(?=.*[a-zA-Z])(.*?)/s'
            ]);*/

            $project->addComment(
                new ProjectComment($request->all())
            );

            Session::flash('userComment', 'Comment submitted');
        }

        return back();
    }
}
