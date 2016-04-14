<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\DeleteProjectRequest;
use App\Project;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Renders the Project View for the given id
     *
     * @param $id project id for lookup
     * @return The project page view
     */
    public function view($id)
    {
        return view('pages.project', ['project' => Project::find($id)]);
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

        $path = str_replace('/app', '', app_path());
        $thumbnail = $request->file('thumbnail');
        $thumbnail->move($path . '/public/images/projects',  'product' . $newEntry->id . '.jpg');

        return redirect('/project/' . $newEntry->id);
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
        $project->delete();

        // TODO: Notice of success?
        return redirect()->action('PagesController@projectfinder');
    }
}
