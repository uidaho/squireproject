<?php

namespace App\Http\Requests;

use App\Project;
use Illuminate\Support\Facades\Session;

/**
 * Class ProjectListRequest
 *
 * Request for listing projects with pagination.
 *
 * @author Rick Boss
 * @package App\Http\Requests
 */
class ProjectListRequest extends PaginatedRequest
{
    /**
     * see @link PaginatedRequest#getViewName()
     *
     * @return string
     */
    public function getViewName()
    {
        return 'project.list';
    }

    /**
     * see @link PaginatedRequest$getViewName()
     * 
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getEntries()
    {
        return Project::all();
    }

    /**
     * Returns whether or not any entries exist.
     *
     * @return bool
     */
    public function isEmpty()
    {
        return Project::count() == 0;
    }

    /**
     * Defined the behavior that should be carried out if there are no 
     * 
     * @return mixed
     */
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
