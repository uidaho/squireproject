<?php

namespace App\Http\Controllers;

use App\Http\Requests\BannerRequest;
use App\Http\Requests\StatementRequest;
use App\Http\Requests\CustomTabRequest;
use App\Project;
use App\User;
use App\File;
use App\ProjectMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProjectMembersController extends Controller
{
    /**
     * Renders the Project Member view for the given project
     *
     * @param Project $project
     * @return The project members page view
     * @internal param 
     */
    public function view(Project $project)
    {
        //Todo verify user is a member of the project

        $userid = Auth::user()->id;
        $files = File::forProject($project)->get();

        return view('project-members.view', ['project' => $project, 'files' => $files, 'userid' => $userid]);
    }

    /**
     * Add a user to this project
     *
     * @param Project $project, User $user
     * @return current view
     */
    public function acceptMembershipRequest(Project $project, User $user)
    {
        //Todo verify user is an admin and can add users to the project

        if (Auth::guest() || !$project->isProjectAdmin())
            return abort(403);

        $project->addMember(false, $user->id);
        $project->deleteMembershipRequest($user->id);
        //Session::flash('membership_request_success', 'You are no longer requesting membership to this project.');

        return back();
    }

    /**
     * Deny a users request to join this project
     *
     * @param Project $project, User $user
     * @return current view
     */
    public function denyMembershipRequest(Project $project, User $user)
    {
        //Todo verify user is an admin and can deny others

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
    public function promoteToAdmin(Project $project, ProjectMember $member)
    {
        //Todo verify user is an admin and can promote others

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
        //Todo verify user is the owner of the project

        $member->admin = false;
        $member->save();

        return back();
    }

    /**
     * Kick member from project
     *
     * @param Project $project, User $user
     * @return current view
     */
    public function kickMember(Project $project, ProjectMember $member)
    {
        //Todo verify user is an admin and can promote others and the member is not a admin or owner

        if (Auth::guest())
            return abort(403);

        $project->deleteMember($member->user_id);
        //Session::flash('membership_request_success', 'You are no longer requesting membership to this project.');

        return back();
    }

    /**
     * Updates the banner with the one supplied by the user
     *
     * @param BannerRequest $request, Project $project
     * @return current view
     */
    public function editBanner(BannerRequest $request, Project $project)
    {
        //Todo verify user is an admin

        $banner = $request->file('banner');
        $banner->move(base_path() . '/public/images/projects',  'banner' . $project->id . '.jpg');

        return back();
    }

    /**
     * Updates the statement title and body with what the user supplied
     *
     * @param StatementRequest $request, Project $project
     * @return current view
     */
    public function editStatement(StatementRequest $request, Project $project)
    {
        //Todo verify user is an admin

        $project->statement_title = $request->getStatementTitle();
        $project->statement_body = $request->getStatementBody();
        $project->save();

        return back();
    }

    /**
     * Updates the custom tab title and body with what the user supplied
     *
     * @param CustomTabRequest $request, Project $project
     * @return current view
     */
    public function editCustomTab(CustomTabRequest $request, Project $project)
    {
        //Todo verify user is an admin

        $project->tab_title = $request->getTabTitle();
        $project->tab_body = $request->getTabBody();
        $project->save();

        return back();
    }
}
