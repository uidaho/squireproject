<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class EditorController extends Controller
{
    /**
     * Renders the editor view for the given project and file
     *
     * @param $project project name $file file name
     * @return mixed
     */
    public function editFile($projectname, $filename)
    {
        return view('editor.edit', ['project' => Project::find($id)]);
    }

    /**
     * Renders the file list view for the given project
     *
     * @param $project project name
     * @return mixed
     */
    public function listFiles($projectname)
    {
        return view('editor.list', ['project' => Project::find($id)]);
    }

    /**
     * Renders the default index page for editor controller
     *
     * @return mixed
     */
    public function index()
    {
        return redirect('/projectfinder');
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
