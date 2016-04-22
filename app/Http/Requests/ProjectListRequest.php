<?php

namespace App\Http\Requests;

use App\Project;
use Illuminate\Support\Facades\Session;

class ProjectListRequest extends PaginatedRequest
{
    public function getEntries()
    {
        return Project::all();
    }

    public function whenEmpty()
    {
        Session::flash('alert', 'There are no projects created yet! Be the <strong>first!</strong>');
        return redirect('/project/create');
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


