<?php

namespace App\Http\Requests;

use App\Project;

/**
 * Class ImportRequest
 *
 * Validation and helper functions for the file import request.
 *
 * @see App\Http\Controllers\CompileController::import
 *
 * @author Rick Boss
 *
 * @package App\Http\Requests
 */
class ImportRequest extends Request
{
    private $project = null;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user() != null;
    }

    /**
     * Gets the project associated with this request.
     *
     * @return \App\Project project
     */
    public function project() {
        if ($this->project == null) {
            $title = urldecode(substr($this->url(), strrpos($this->url(), '/') + 1));
            $this->project = Project::fromName($title)->firstOrFail();
        }
        return $this->project;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fileName' => 'required|unique:files,filename,NULL,id,project_id,' . $this->project()->id . '|max:255|regex:/([A-Za-z0-9_.-]+)/',
            'description'   => 'required',
            'fileImport' => 'required'
        ];

    }
}
