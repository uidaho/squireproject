<?php

namespace App\Http\Controllers;

use App\File;
use App\Http\Requests;
use App\Project;
use Firebase\FirebaseLib;
use Illuminate\Support\Facades\Response;

class CompileController extends Controller
{
    /**
     * Compiles an entire Project by downloading the files
     * from firebase, compiling them, and packaging them in
     * an executable jar with Main#main being the entry point.
     *
     * @param Project $project the project to compile
     * @return string encoded string with results.
     *          On Success:
     *              result => 'success'
     *              downloadUrl => <some url for jar download>
     *          on Failure:
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
     * referring to the timestamp of compilation - used
     * internally and only exposed in the url.
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

    private function makeTempDirectory($directoryName, $projectTitle) {
        $key = $projectTitle . '_' . time();
        $path = base_path($directoryName . '/' . $key);
        mkdir($path);
        return $path;
    }

    public function getFirebaseFiles($files, $toPath) {
        $filesDownloaded = [];
        $connector = $this->getFirebaseConnector();

        foreach ($files as $file) {
            array_push($filesDownloaded, $this->getFirebaseFile($file, $toPath, $connector));
        }

        return $filesDownloaded;
    }

    public function getFirebaseFile($file, $toPath, FirebaseLib $connector) {
        $contents = $this->getFirebaseFileContents($file, $connector);
        $filePath = $toPath . '/' . $file->filename;

        file_put_contents($filePath, $contents);

        return $filePath;
    }

    public function getFirebaseFileContents(File $file, FirebaseLib $firebase) {
        $firebaseFilePath = '/' . $file->project_id . '/' . $file->id;
        return json_decode(
            utf8_encode(
                $firebase->get($firebaseFilePath)
            )
        )->checkpoint->o[0];
    }

    public function getFirebaseConnector() {
        return new FirebaseLib(env('FIREBASE_URL'), env('FIREBASE_TOKEN'));
    }
}
