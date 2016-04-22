<?php

namespace App\Http\Requests;

use App\Project;

class ProjectListRequest extends Request
{
    use SortableRequest, SortableEntries;

    public function getEntries()
    {
        return Project::all();
    }

    public function getModelName()
    {
        return 'Project';
    }
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}


