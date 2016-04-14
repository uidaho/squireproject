<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\DeleteProjectRequest;
use App\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProjectController extends Controller
{
    /**
     * Renders the Project View for the given id
     *
     * @param Project $project
     * @return The project page view
     * @internal param Project $id id for lookup
     */
    public function view(Project $project)
    {
        return view('pages.project', ['project' => $project]);
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
        return view('pages.project-create');
    }

    /**
     * Creates a new project using the input from the form
     *
     * @param CreateProjectRequest $request The validated request
     * @return mixed
     */
    public function create(CreateProjectRequest $request)
    {
        $title = $request->input('title');
        $description = $request->input('description');
        $body = $request->input('project-body');

        $newEntry = Project::create([
            'author' => Auth::user()->username,
            'title'  => $title,
            'description' => $description,
            'body' => $body
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
        return redirect()->action('PagesController@projectfinder');
    }
}
