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

        //Sets banner image to a random pre-made banner
        $images = glob(base_path() . "/public/images/banners/*");
        $imagePath = base_path() . '/public/images/projects/' . 'banner' . $newEntry->id . '.jpg';
        $rand = random_int(0, count($images) - 1);
        \File::copy($images[$rand], $imagePath);

        //Add creator as a member and make admin of the project
        $newEntry->addMember(true);
        //Add creator as a follower of the project
        $newEntry->addFollower();

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
        return redirect('/projects');
    }

    /**
     * Add a follower to the project
     *
     * @param Project $project
     * @return current view
     */
    public function follow(Project $project)
    {
        $this->authorize('userIsNotFollower', $project);

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
        $this->authorize('userIsFollower', $project);

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
        $this->authorize('userIsNotMember', $project);

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
        $this->authorize('verifyPendingRequest', $project);

        $project->deleteMembershipRequest();
        Session::flash('membership_request_success', 'You are no longer requesting membership to this project.');

        return back();
    }

    /**
     * Remove current user from project
     *
     * @param Project $project
     * @return current view
     */
    public function leaveProject(Project $project)
    {
        $this->authorize('userIsMember', $project);

        $project->deleteMember();
        Session::flash('member_success', 'You are now not a member of project.');

        return back();
    }
}
