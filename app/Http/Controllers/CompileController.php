<?php

namespace App\Http\Controllers;

use App\File;
use App\Http\Requests;
use App\Http\Requests\ImportRequest;
use App\Project;
use Firebase\FirebaseLib;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Response;

/**
 * Class CompileController
 *
 * The controller responsible for handling all incoming
 * compile requests.
 *
 * @author Rick Boss
 * @package App\Http\Controllers
 */
class CompileController extends Controller
{
    /**
     * Compiles an entire Project by downloading the files
     * from Firebase, compiling them, and packaging them in
     * an executable jar with Main#main being the entry point.
     *
     * @param Project $project the project to compile
     * @return string encoded string with results.
     *          On Success:
     *              result => 'success'
     *              downloadUrl => <some url for jar download>
     *          On Failure:
     *              result => 'failed'
     *              message => <a brief message>
     *              redirect => <some redirect url to handle the failure>
     */
    public function compile(Project $project) {
        $projectTitle = $project->title;
        $files = File::forProject($project)->get();

        if (count($files) == 0) {
            return null;
        }

        $compilationPath = $this->makeTempDirectory('compile', $projectTitle);
        $key = substr($compilationPath, strpos($compilationPath, '_') + 1);

        $fileNames = $this->getFirebaseFiles($files, $compilationPath);

        $failRedirect = '/editor/compilation/' . $projectTitle . '/' . $key;

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

        $jarOutput = shell_exec('cd "' . $compilationPath . '"; jar cvfe "' . $projectTitle . '.jar" Main *');

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
            'downloadUrl' =>  '/editor/downloadCompilation/' . $projectTitle . '/' . $key
        ]);
    }

    /**
     * Download the compilation for this project with this key,
     * referring to the timestamp of compilation - used internally
     * and only exposed in the url.
     *
     * @param Project $project
     * @param integer $key timestamp
     * @return Response The download
     */
    public function downloadProjectCompilation(Project $project, $key) {
        $title = $project->title;
        $path = base_path('compile/' . $title . '_' . $key . '/' . $title . '.jar');

        $headers = array (
            'Content-Type: application/java-vm',
        );

        return Response::download($path, $title . '.jar', $headers);
    }

    /**
     * Handles an incoming import request. Takes the uploaded file, creates
     * a new entry in the database for it with its contents, and relies on the fact that the
     * Editor will create a new file in Firebase out of the contents of the entry.
     *
     * @param ImportRequest $request
     * @return mixed
     */
    public function import(ImportRequest $request) {
        $project = $request->project();

        $path = $this->makeTempDirectory('tmp', $request->project()->title);
        $fileName = $request->input('fileName');

        $import = $request->file('fileImport');
        $import->move($path, $fileName);
        $contents = str_replace("\r\n", '\n', file_get_contents($path . '/' . $fileName));

        $newEntry = File::create([
            'project_id'    => $project->id,
            'projectname'   => $project->title,
            'filename'      => $request->input('fileName'),
            'type'          => 'File',
            'description'   => $request->input('description'),
            'contents'      => $contents,
            'user_id'       => $request->user()->id,
            'parent'        => 0 // TODO: no parent for now, flat file system
        ]);

        return redirect('/editor/edit/' . $newEntry->projectname . '/' . $newEntry->filename);
    }

    /**
     * Renders the Import page for a project.
     *
     * @param Project $project
     * @return mixed
     */
    public function importView(Project $project) {
        return view('editor.import', ['project' => $project]);
    }

    /**
     * Takes an incoming export request and returns a download of the
     * file associated with it from Firebase.
     *
     * @param Project $project
     * @param $fileName
     * @return null
     */
    public function exportFile(Project $project, $fileName) {
        $file = File::forProject($project)->where('filename', $fileName)->first();
        if (!$file) {
            return null;
        }

        $filePath = $this->getFirebaseFile($file, base_path('tmp'), $this->getFirebaseConnector());

        return Response::download($filePath, $fileName);

    }

    /**
     * For viewing the results of a failed compilation. Extracts the error
     * message from the 'result' file within the compilation directory.
     *
     * @param Project $project the project
     * @param int $key timestamp of compilation
     * @return mixed
     */
    public function viewCompilation(Project $project, $key) {
        $contents = file_get_contents(base_path('compile/' . $project->title . '_' . $key . '/result'));

        return view('editor.compilation', compact(['key', 'contents']));
    }

    /**
     * Creates a temporary directory to be used during some process. Used by
     * Export to cache the file and by Compile to stage the project for
     * compilation. Uses the timestamp concatenated to the project title to create uniqueness
     *
     * @param string $directoryName The base name of the directory in the app directory.
     * @param string $projectTitle The title of the project
     * @return string $path The path of the newly generated temporary directory
     */
    private function makeTempDirectory($directoryName, $projectTitle) {
        $key = $projectTitle . '_' . time();
        $path = base_path($directoryName . '/' . $key);
        mkdir($path);
        return $path;
    }

    /**
     * Downloads a collection of Files from Firebase to the directory
     * given.
     *
     * @param Collection $files The Files
     * @param string $toPath The path of the directory to populate.
     * @return array $filesDownloaded The list of the paths to the downloaded files
     */
    public function getFirebaseFiles($files, $toPath) {
        $filesDownloaded = [];
        $connector = $this->getFirebaseConnector();

        foreach ($files as $file) {
            array_push($filesDownloaded, $this->getFirebaseFile($file, $toPath, $connector));
        }

        return $filesDownloaded;
    }

    /**
     * Downloads a single file from Firebase to a given directory.
     *
     * @param File $file The file to download
     * @param string $toPath The path to download the file to
     * @param FirebaseLib $connector An isntance of a Firebase connector
     * @return string $filePath the path to the file downloaded
     */
    public function getFirebaseFile(File $file, $toPath, FirebaseLib $connector) {
        $contents = $this->getFirebaseFileContents($file, $connector);
        $filePath = $toPath . '/' . $file->filename;

        file_put_contents($filePath, $contents);

        return $filePath;
    }

    /**
     * Gets the contents of a file from Firebase using the last checkpoint
     * recorded for the file. The Editor is configured to checkpoint on every
     * change, for ease of compilation.
     *
     * @param File $file
     * @param FirebaseLib $firebase
     * @return mixed
     */
    public function getFirebaseFileContents(File $file, FirebaseLib $firebase) {
        $firebaseFilePath = '/' . $file->project_id . '/' . $file->id;
        return json_decode(
            utf8_encode(
                $firebase->get($firebaseFilePath)
            )
        )->checkpoint->o[0];
    }

    /**
     * Get an instance of the Firebase connector using the url and token
     * from the environment variables.
     *
     * @return FirebaseLib
     */
    public function getFirebaseConnector() {
        return new FirebaseLib(env('FIREBASE_URL'), env('FIREBASE_TOKEN'));
    }
}
