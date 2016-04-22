<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\DeleteProjectRequest;
use App\Project;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class ProjectController extends Controller
{
	public function listProjects()
	{
        $allProjects = Project::all();
        $sorting = Request::has('sort');

        if ($sorting) {
            $allProjects = $allProjects->sortBy(Request::get('sort'));
        }

        $page = Paginator::resolveCurrentPage('page');
        $perPage = $allProjects->first()->getPerPage();

        if (($page - 1) * $perPage > count($allProjects)) {
            return redirect(Request::fullURLWithQuery(['page' => (int) (count($allProjects) / $perPage)]));
        }

        $projects = new LengthAwarePaginator($allProjects->splice(($page - 1) * $perPage, $perPage), Project::query()->toBase()->getCountForPagination(), $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page'
        ]);

        return view('project.list', compact(['projects', 'sorting']));
	}
	
    /**
     * Renders the Project View for the given id
     *
     * @param Project $project
     * @return The project page view
     * @internal param Project $id id for lookup
     */
    public function view(Project $project)
    {
        return view('project.view', ['project' => $project]);
    }

    /**
     * Renders the project creation view if user is logged in
     *
     * @return mixed
     */
    public function createForm()
    {
        if (Auth::guest()) {
            return redirect('/login');
        }
        return view('project.create');
    }

    /**
     * Creates a new project using the input from the form
     *
     * @param CreateProjectRequest $request The validated request
     * @return mixed
     */
    public function create(CreateProjectRequest $request)
    {
        $newEntry = Project::create([
            'author' => Auth::user()->username,
            'title'  => $request->getTitle(),
            'description' => $request->getDescription(),
            'body' => $request->getBody()
        ]);

        $thumbnail = $request->file('thumbnail');
        $thumbnail->move(base_path() . '/public/images/projects',  'product' . $newEntry->id . '.jpg');

        return redirect($newEntry->getSlug());
    }

    /**
     * Deletes the project give by the id, only if the user
     * is authenticated and is the author.
     *
     * @param DeleteProjectRequest $request
     * @return mixed
     */
    public function delete(DeleteProjectRequest $request)
    {
        $project = $request->project;
        $title = $project->title;
        $project->delete();

        Session::flash('delete-success', 'Successfully deleted the project "' . $title .'"');
        return redirect()->action('ProjectController@listProjects');
    }

    /**
     * Add a follower to the project
     *
     * @param Project $project
     * @return current view
     */
    public function addFollower(Project $project)
    {
        if (Auth::guest())
            return abort(403);

        $project->addFollower();
        Session::flash('follow_success', 'You are now following this project.');

        return back();
    }

    /**
     * Remove a follower from this project
     *
     * @param Project $project
     * @return current view
     */
    public function removeFollower(Project $project)
    {
        if (Auth::guest())
            return abort(403);

        $project->deleteFollower();
        Session::flash('unfollow_success', 'You are now not following this project.');

        return back();
    }
}
