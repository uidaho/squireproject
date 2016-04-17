<?php

namespace App\Http\Controllers;

use Cache;
use App\File;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;

class EditorController extends Controller
{
    
    public function __construct()
    {
        //$this->middleware('auth');
    }
    
    /**
     * Renders the editor view for the given project and file
     *
     * @param string $projectname project name
     * @param string $filename file name
     * @return mixed
     */
    public function editFile($projectname, $filename)
    {
        $userid = Auth::user()->id;
        $username = Auth::user()->username;

        $file = File::where('projectname', $projectname)
                    ->where('filename', $filename)
                    ->firstOrFail();

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
        $userid = Auth::user()->id;
        
        $files = File::where('projectname', $projectname)
                    ->orderBy('filename', 'asc')
                    ->get();

        if (empty($files[0])) {
            return redirect('/editor/create/'.$projectname);
        }

        return view('editor.list', ['files' => $files, 'userid' => $userid]);
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
        // TODO: handle non-existant projectname

        $this->validate($request, [
            'filename'      => 'required|unique:files|max:255|regex:/([A-Za-z0-9_.-]+)/',
            'description'   => 'required',
            'type'          => 'required',
        ]);

        $newEntry = File::create([
            'project_id'    => 1,
            'projectname'   => $projectname,
            'filename'      => $request->input('filename'),
            'type'          => $request->input('type'),
            'description'   => $request->input('description'),
            'contents'      => "/* ".EditorController::quoteOfTheDay()." */",
            'user_id'       => Auth::user()->id,
            'parent'        => 0 // TODO: no parent for now, flat file system
        ]);

        return redirect('/editor/edit/' . $newEntry->projectname . '/' . $newEntry->filename);
    }

    /**
     * Returns a cached string that contains a random quote.
     *
     * @return string $quote
     */
    public function quoteOfTheDay()
    {
        if (Cache::has('EditorController@quoteOfTheDay')) {
            $quote = Cache::get('EditorController@quoteOfTheDay');
        } else {
            $quote = file_get_contents('http://api.icndb.com/jokes/random?limitTo=[nerdy]&exclude=[explicit]');
            $quote = html_entity_decode(json_decode(utf8_encode($quote))->value->joke);
            Cache::put('EditorController@quoteOfTheDay', $quote, 1);
        }

        return $quote;
    }

    /**
     * Displays the form to create a file for the given project.
     *
     * @param string $projectname project name 
     * @return mixed
     */
    public function createView($projectname)
    {
        if ($projectname) {
            return view('editor.create', ['projectname' => $projectname]);
        } else {
            // TODO: return error
        }
    }

    /**
     * Deletes a file given by the project and file name.
     *
     * @param string $projectname project name 
     * @param string $filename file name
     * @return mixed
     */
    public function delete($projectname, $filename)
    {
        $file = File::where('projectname', $projectname)->where('filename', $filename)->firstOrFail();
        
        if ($file->user_id == Auth::user()->id) { // for now, only allow creator user_id to delete their file
            // delete file from firebase
            $firebase_path = '/' + $file->project_id + '/' + $file->id;
            $firebase = new \Firebase\FirebaseLib(env('FIREBASE_URL'), env('FIREBASE_TOKEN'));
            $firebase->delete($firebase_path);
            
            // delete file record from database
            File::where('projectname', $projectname)->where('filename', $filename)->delete();
        }

        // TODO: Notice of success
        return redirect('/editor/list/'.$projectname);
    }
    
    /**
     * Displays the form view to confirm the deletion of a file given by the project and file name.
     *
     * @param string $projectname project name 
     * @param string $filename file name
     * @return mixed
     */
    public function deleteView($projectname, $filename)
    {
        if ($projectname && $filename) {
            return view('editor.delete', ['projectname' => $projectname, 'filename' => $filename]);
        } else {
            return abort(404);
        }
    }
}
