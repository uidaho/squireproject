<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

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
}
