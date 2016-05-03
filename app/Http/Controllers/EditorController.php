<?php

namespace App\Http\Controllers;

use Cache;
use App\File;
use App\Project;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EditorController extends Controller
{
    
    /**
     * Runs before every method in the class, useful for what's below.
     */
    public function __construct()
    {
        /**
         * This will require login for the entire controller and then return
         * the user back where they were going.
         */
        $this->middleware('auth');
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
        $project = Project::where('title', $projectname)->firstOrFail();

        $file = File::where('project_id', $project->id)
                    ->where('filename', $filename)
                    ->firstOrFail();

        return view('editor.edit', ['file' => $file, 'userid' => $userid, 'username' => $username, 'project' => $project]);
    }

    /**
     * Renders the file list view for the given project
     *
     * @param string $projectname project name
     * @return mixed
     */
    public function listFiles(Project $project)
    {
        $userid = Auth::user()->id;
        $files = File::forProject($project)->get();

<<<<<<< HEAD
        return view('editor.list', ['project' => $project, 'files' => $files, 'userid' => $userid]);
=======
        if (empty($files[0])) {
            File::create([
                'project_id'    => $project->id,
                'projectname'   => $project->title,
                'filename'      => 'Main.java',
                'type'          => 'File',
                'description'   => 'Entry point of the project',
                'contents'      => '/* Program starts here. */\npublic class Main {\n\tpublic static void main(String[] args) {\n\t\n\t}\n}',
                'user_id'       => Auth::user()->id,
                'parent'        => 0
            ]);
            $files = File::forProject($project)->get();
        }

        return view('editor.list', ['files' => $files, 'userid' => $userid, 'username' => $username, 'project' => $project]);
>>>>>>> Implemented default entry point in Main.java
    }

    /**
     * Renders the default index page for editor controller
     *
     * @return mixed
     */
    public function index()
    {
        return redirect('/projects');
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
        $project = Project::where('title', $projectname)->firstOrFail();

        $this->validate($request, [
            'filename'      => 'required|unique:files,filename,NULL,id,project_id,'.$project->id.'|max:255|regex:/([A-Za-z0-9_.-]+)/',
            'description'   => 'required',
        ]);

        $newEntry = File::create([
            'project_id'    => $project->id,
            'projectname'   => $project->title,
            'filename'      => $request->input('filename'),
            'type'          => 'File',
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

    public function compileProject($projectname) {
        $files = File::where('projectname', $projectname)->get();

        if (count($files) == 0) {
            return null;
        }

        $firebase = new \Firebase\FirebaseLib(env('FIREBASE_URL'), env('FIREBASE_TOKEN'));

        $compilationPath = $this->makeCompilationDirectory($projectname);
        $fileNames = [];

        foreach ($files as $file) {
            $contents = $this->getFirebaseFileContents($file, $firebase);
            $filePath = $compilationPath . '/' . $file->filename;

            array_push($fileNames, $filePath);
            file_put_contents($filePath, $contents);
        }

        $key = substr($compilationPath, strpos($compilationPath, '_') + 1);

        $failRedirect = '/editor/compilation/' . $projectname . '/' . $key;

        $output = shell_exec('cd "' . $compilationPath . '"; javac *.java 2>&1');
        if ($output != null) {
            file_put_contents($compilationPath . '/result', $output);
            return json_encode([
                'status' => 'failed',
                'message' => 'Failed in compilation phase.',
                'redirect' => $failRedirect
            ]);
        }

        array_walk($fileNames, function($path) {
            if (strpos($path, '.java') !== FALSE) {
                unlink($path);
            }
        });

        $jarOutput = shell_exec('cd "' . $compilationPath . '"; jar cvfe "' . $projectname . '.jar" Main *');

        if ($jarOutput == null) {
            file_put_contents($compilationPath . '/result', $jarOutput);
            return json_encode([
                'status' => 'failed',
                'message' => 'Failed in jar packaging phase.',
                'redirect' => $failRedirect
            ]);
        }

        return json_encode([
            'status' => 'success',
            'downloadUrl' =>  '/editor/downloadCompilation/' . $projectname . '/' . $key
        ]);
    }

    public function makeCompilationDirectory($projectname) {
        $key = $projectname . '_' . time();
        $path = base_path('compile/' . $key);
        mkdir($path);
        return $path;
    }

    public function getFirebaseFileContents(File $file, \Firebase\FirebaseLib $firebase) {
        $firebaseFilePath = '/' . $file->project_id . '/' . $file->id;
        return json_decode(
            utf8_encode(
                $firebase->get($firebaseFilePath)
            )
        )->checkpoint->o[0];
    }


    public function compile($projectname, $filename)
    {
        $file = File::where('projectname', $projectname)->where('filename', $filename)->firstOrFail();
        $firebase_path = '/' . $file->project_id . '/' . $file->id;

        $firebase = new \Firebase\FirebaseLib(env('FIREBASE_URL'), env('FIREBASE_TOKEN'));

        $contents = json_decode(utf8_encode($firebase->get($firebase_path)))->checkpoint->o[0];

        $key = $projectname . '_' . time();
        $path = base_path('compile/' . $key);
        mkdir($path);

        $filePath = $path . '/' . $filename;

        file_put_contents($filePath, $contents);
        $command = 'javac "' . $filePath . '" 2>&1';
        $output = shell_exec($command);

        return view('editor.compile', compact(['file', 'output', 'key']));
    }

    public function downloadCompilation($projectname, $filename, $key)
    {
        $compiledName = str_replace('java', 'class', $filename);
        $path = base_path('compile/' . $key . '/' . $compiledName);

        $headers = array(
            'Content-Type: application/java-vm',
        );

        return \Illuminate\Support\Facades\Response::download($path, $compiledName, $headers);
    }

    public function downloadProjectCompilation($projectname, $key) {
        $path = base_path('compile/' . $projectname . '_' . $key . '/' . $projectname . '.jar');

        $headers = array (
            'Content-Type: application/java-vm',
        );

        return \Illuminate\Support\Facades\Response::download($path, $projectname . '.jar', $headers);
    }

    public function viewCompilation($projectname, $key) {
        $contents = file_get_contents(base_path('compile/' . $projectname . '_' . $key . '/result'));

        return view('editor.compilation', compact(['key', 'contents']));
    }
}

