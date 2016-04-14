<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;

class EditorController extends Controller
{
    /**
     * Renders the editor view for the given project and file
     *
     * @param string $projectname project name
     * @param string $filename file name
     * @return mixed
     */
    public function editFile($projectname, $filename)
    {
        if (Auth::guest()) {
            return redirect('/login');
        }

        $userid = Auth::user()->id;

        $file = File::where('projectname', $projectname)->where('filename', $filename)->firstOrFail();

        return view('editor.edit', ['file' => $file, 'userid' => $userid]);
    }

    /**
     * Renders the file list view for the given project
     *
     * @param string $projectname project name
     * @return mixed
     */
    public function listFiles($projectname)
    {
        $files = File::where('projectname', $projectname)->get();

        return view('editor.list', ['files' => $files]);
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
     * Creates a new file using the input from the form
     *
     * @param Request  $request
     * @param $projectname project name
     * @return mixed
     */
    public function create(Request $request, $projectname)
    {
        if (Auth::guest()) {
            return redirect('/login');
        }

        $this->validate($request, [
            'filename' => 'required|unique:files|max:255',
            'description' => 'required',
        ]);

        $filename = $request->input('filename');
        $type = "file"; // TODO: just type file for now, no folders
        $description = $request->input('description');
        $contents = "The default file contents.";
        $creator = Auth::user()->id;
        $parent = 0; // TODO: no parent for now, flat file system

        $newEntry = File::create([
            'projectname' => $projectname,
            'filename' => $filename,
            'type' => $type,
            'description' => $description,
            'contents' => $contents,
            'creator' => $creator,
            'parent' => $parent
        ]);

        return redirect('/editor/' . $newEntry->projectname . '/' . $newEntry->filename);
    }

    public function createView($projectname)
    {
        if (Auth::guest()) {
            return redirect('/login');
        }

        if ($projectname) {
            return view('editor.create', ['projectname' => $projectname]);
        } else {
            // TODO: return error
        }
    }

    /**
     * Deletes a file given by the project and file name.
     *
     * @param $projectname projectname project name $filename file name
     * @return mixed
     */
    public function delete($projectname, $filename)
    {
        if (Auth::guest()) {
            return redirect('/login');
        }

        $file = File::where('projectname', $projectname)->where('filename', $filename)->firstOrFail();

        if ($file == null) {
            // TODO: Redirect to an error page
            return redirect('/editor/'.$projectname);
        }

        $file->delete();

        // TODO: Notice of success?
        return redirect('/editor/'.$projectname);
    }
}
