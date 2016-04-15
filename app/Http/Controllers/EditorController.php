<?php

namespace App\Http\Controllers;

use Cache;
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
        $username = Auth::user()->username;

        $file = File::where('projectname', $projectname)->where('filename', $filename)->firstOrFail();

        return view('editor.edit', ['file' => $file, 'userid' => $userid, 'username' => $username]);
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
            'filename' => 'required|unique:files|max:255|regex:/([A-Za-z0-9_.-]+)/',
            'description' => 'required',
        ]);

        $filename = $request->input('filename');
        $type = "file"; // TODO: just type file for now, no folders
        $description = $request->input('description');

        $contents = "/* ".quoteOfTheDay()." */";
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

        return redirect('/editor/edit/' . $newEntry->projectname . '/' . $newEntry->filename);
    }

    public function quoteOfTheDay()
    {
        if (Cache::has('EditorController@quoteOfTheDay')) {
            $quote = Cache::get('EditorController@quoteOfTheDay');
        } else {
            $quote = file_get_contents('http://api.icndb.com/jokes/random?limitTo=[nerdy]&exclude=[explicit]');
            $quote = json_decode(utf8_encode(html_entity_decode($quote->value->joke)));
            Cache::put('EditorController@quoteOfTheDay', $quote, 1);
        }

        return $quote;
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
