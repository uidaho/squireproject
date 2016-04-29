<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\DeleteProjectRequest;
use App\Http\Requests\ProjectListRequest;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProjectController extends Controller
{
    /**
     * The view for /projects. Lists all the projects taking into
     * account the active page and the sorting of the projects.
     *
     * @param ProjectListRequest $request
     * @return mixed
     */
    public function listProjects(ProjectListRequest $request)
    {
        $sorting = $request->getSortKey();
        $friendly = $request->getSortKeyFriendly();
        $order = $request->getSortOrderFriendly();
            
        return $request->renderViewOrEmpty('projects', compact(['sorting', 'friendly', 'order']));
    }
	
    /**
     * Renders the Project View for the given id
     *
     * @param Project $project
     * @return The project page view
     * @internal param Project $id id for lookup
     */
    public function view($projectname)
    {
        $project = Project::where('title', $projectname)->firstOrFail();
        
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
            'user_id' => Auth::user()->id,
            'title'  => $request->getTitle(),
            'description' => $request->getDescription(),
            'body' => $request->getBody(),
            'statement_title' => 'Mission Statement',
            'statement_body' => 'This is where you write about your mission statement or make it whatever you want.',
            'tab_title' => 'Welcome',
            'tab_body' => 'Here you can write a message or maybe the status of your project for all your members to see.',
        ]);

        $thumbnail = $request->file('thumbnail');
        $thumbnail->move(base_path() . '/public/images/projects',  'product' . $newEntry->id . '.jpg');

        //Todo set banner image

        //Add creator as a member and make admin of the project
        $newEntry->addMember(true);

        return redirect('/project/'.$newEntry->title);
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
    public function follow(Project $project)
    {
        //Todo verify user isnt already following the project

        if (Auth::guest())
            return abort(403);

        $project->addFollower();
        Session::flash('follower_success', 'You are now following this project.');

        return back();
    }

    /**
     * Remove a follower from this project
     *
     * @param Project $project
     * @return current view
     */
    public function unFollow(Project $project)
    {
        //Todo verify user is a follower of the project

        if (Auth::guest())
            return abort(403);

        $project->deleteFollower();
        Session::flash('follower_success', 'You are now not following this project.');

        return back();
    }

    /**
     * Put a request in to join the project
     *
     * @param Project $project
     * @return current view
     */
    public function requestMembership(Project $project)
    {
        //Todo verify user isnt already a member

        if (Auth::guest())
            return abort(403);

        $project->addMembershipRequest();
        Session::flash('membership_request_success', 'Your request is waiting approval from a project admin.');

        return back();
    }

    /**
     * Cancel request to join project
     *
     * @param Project $project
     * @return current view
     */
    public function cancelMembershipRequest(Project $project)
    {
        //Todo verify user has a pending join request

        if (Auth::guest())
            return abort(403);

        $project->deleteMembershipRequest();
        Session::flash('membership_request_success', 'You are no longer requesting membership to this project.');

        return back();
    }

    /**
     * Remove member from project
     *
     * @param Project $project
     * @return current view
     */
    public function leaveProject(Project $project)
    {
        //Todo verify user is already a member of the project

        if (Auth::guest())
            return abort(403);

        $project->deleteMember();
        Session::flash('member_success', 'You are now not a member of project.');

        return back();
    }
}
