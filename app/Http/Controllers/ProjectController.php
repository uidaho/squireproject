<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\DeleteProjectRequest;
use App\Http\Requests\ProjectListRequest;
use App\Http\Requests\BannerRequest;
use App\Http\Requests\StatementRequest;
use App\Http\Requests\CustomTabRequest;
use App\Project;
use App\User;
use App\ProjectMember;
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

        //Set project members page's banner
        $banner = "public/images/banners/banner1.jpg";
        $imagePath = 'public/images/projects/' . 'banner' . $newEntry->id . '.jpg';
        \File::copy($banner, $imagePath);

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
    public function addFollower(Project $project)
    {
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
    public function removeFollower(Project $project)
    {
        if (Auth::guest())
            return abort(403);

        $project->deleteFollower();
        Session::flash('follower_success', 'You are now not following this project.');

        return back();
    }

    /**
     * Remove a follower from this project
     *
     * @param Project $project
     * @return current view
     */
    public function removeMember(Project $project)
    {
        if (Auth::guest())
            return abort(403);

        $project->deleteMember();
        Session::flash('member_success', 'You are now not a member of project.');

        return back();
    }

    /**
     * Add a follower to the project
     *
     * @param Project $project
     * @return current view
     */
    public function requestMembership(Project $project)
    {
        if (Auth::guest())
            return abort(403);

        $project->addMembershipRequest();
        Session::flash('membership_request_success', 'Your request is waiting approval from a project admin.');

        return back();
    }

    /**
     * Remove a follower from this project
     *
     * @param Project $project
     * @return current view
     */
    public function removeMembershipRequest(Project $project)
    {
        if (Auth::guest())
            return abort(403);

        $project->deleteMembershipRequest();
        Session::flash('membership_request_success', 'You are no longer requesting membership to this project.');

        return back();
    }

    /**
     * Remove a follower from this project
     *
     * @param Project $project
     * @return current view
     */
    public function acceptMembershipRequest(Project $project, User $user)
    {
        if (Auth::guest() || !$project->isProjectAdmin())
            return abort(403);

        $project->addMember(false, $user->id);
        $project->deleteMembershipRequest($user->id);
        //Session::flash('membership_request_success', 'You are no longer requesting membership to this project.');

        return back();
    }

    /**
     * Remove a follower from this project
     *
     * @param Project $project
     * @return current view
     */
    public function denyMembershipRequest(Project $project, User $user)
    {
        if (Auth::guest())
            return abort(403);

        $project->deleteMembershipRequest($user->id);
        //Session::flash('membership_request_success', 'You are no longer requesting membership to this project.');

        return back();
    }

    /**
     *
     *
     * @param
     * @return
     */
    public function membersHome(Project $project)
    {
        $userid = Auth::user()->id;
        $files = File::forProject($project)->get();

        return view('project-members.view', ['project' => $project, 'files' => $files, 'userid' => $userid]);
    }

    /**
     *
     *
     * @param
     * @return
     */
    public function promoteToAdmin(Project $project, ProjectMember $member)
    {
        $member->admin = true;
        $member->save();

        return back();
    }

    /**
     *
     *
     * @param
     * @return
     */
    public function demoteFromAdmin(Project $project, ProjectMember $member)
    {
        $member->admin = false;
        $member->save();

        return back();
    }

    /**
     * Creates a new project using the input from the form
     *
     * @param CreateProjectRequest $request The validated request
     * @return mixed
     */
    public function editBanner(BannerRequest $request, Project $project)
    {
        $banner = $request->file('banner');
        $banner->move(base_path() . '/public/images/projects',  'banner' . $project->id . '.jpg');

        return back();
    }

    /**
     * Creates a new project using the input from the form
     *
     * @param CreateProjectRequest $request The validated request
     * @return mixed
     */
    public function editStatement(StatementRequest $request, Project $project)
    {
        //$project->statement_title = $request->getStatementTitle();
        $project->statement = $request->getStatement();
        $project->save();

        return back();
    }

    /**
     * Creates a new project using the input from the form
     *
     * @param CreateProjectRequest $request The validated request
     * @return mixed
     */
    public function editCustomTab(CustomTabRequest $request, Project $project)
    {
        $project->tab_title = $request->getTabTitle();
        $project->tab_body = $request->getTabBody();
        $project->save();

        return back();
    }
}
