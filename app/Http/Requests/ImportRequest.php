<?php

namespace App\Http\Requests;

use App\Project;

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

    public function project() {
        if ($this->project == null) {
            $this->project = Project::fromName(substr($this->url(), strrpos($this->url(), '/') + 1))->firstOrFail();
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
