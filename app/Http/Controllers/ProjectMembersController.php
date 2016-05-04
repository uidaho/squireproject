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
        $this->authorize('userIsMember', $project);

        $userid = Auth::user()->id;
        $files = File::forProject($project)->get();

        if (count($files) == 0) {

            File::create([
                'project_id' => $project->id,
                'projectname' => $project->title,
                'filename' => 'Main.java',
                'type' => 'File',
                'description' => 'Entry point of ' . $project->title . '.',
                'contents' => '/* Program starts here. */\npublic class Main {\n\tpublic static void main(String[] args) {\n\t\n\t}\n}',
                'user_id' => Auth::user()->id,
                'parent' => 0 // TODO: no parent for now, flat file system
            ]);
        }
        $files = File::forProject($project)->get();

        return view('project-members.view', ['project' => $project, 'files' => $files, 'userid' => $userid]);
    }

    /**
     * Add a user to this project
     *
     * @param Project $project
     * @param User $user
     * @return current view
     */
    public function acceptMembershipRequest(Project $project, User $user)
    {
        $this->authorize('authToAddDeny', [$project, $user->id]);

        $project->addMember(false, $user->id);
        $project->deleteMembershipRequest($user->id);
        //Session::flash('membership_request_success', 'You are no longer requesting membership to this project.');

        return back();
    }

    /**
     * Deny a users request to join this project
     *
     * @param Project $project
     * @param User $user
     * @return current view
     */
    public function denyMembershipRequest(Project $project, User $user)
    {
        $this->authorize('authToAddDeny', [$project, $user->id]);

        $project->deleteMembershipRequest($user->id);
        //Session::flash('membership_request_success', 'You are no longer requesting membership to this project.');

        return back();
    }

    /**
     * Promote the given user to admin
     *
     * @param Project $project
     * @param ProjectMember $member
     * @return current view
     */
    public function promoteToAdmin(Project $project, ProjectMember $member)
    {
        $this->authorize('userIsAdmin', $project);
        $this->authorize('userIsNotAdmin', [$project, $member]);

        $member->admin = true;
        $member->save();

        return back();
    }

    /**
     * Demote the given admin to member
     *
     * @param Project $project
     * @param ProjectMember $member
     * @return current view
     */
    public function demoteFromAdmin(Project $project, ProjectMember $member)
    {
        $this->authorize('userIsOwner', $project);
        $this->authorize('userIsMember', [$project, $member]);

        $member->admin = false;
        $member->save();

        return back();
    }

    /**
     * Kick member from project
     *
     * @param Project $project
     * @param ProjectMember $member
     * @return current view
     */
    public function kickMember(Project $project, ProjectMember $member)
    {
        $this->authorize('authToKick', [$project, $member]);

        $project->deleteMember($member->user_id);
        //Session::flash('membership_request_success', 'You are no longer requesting membership to this project.');

        return back();
    }

    /**
     * Updates the banner with the one supplied by the user
     *
     * @param BannerRequest $request
     * @param Project $project
     * @return current view
     */
    public function editBanner(BannerRequest $request, Project $project)
    {
        $this->authorize('userIsAdmin', $project);

        $banner = $request->file('banner');
        $banner->move(base_path() . '/public/images/projects',  'banner' . $project->id . '.jpg');

        return back();
    }

    /**
     * Updates the statement title and body with what the user supplied
     *
     * @param StatementRequest $request
     * @param Project $project
     * @return current view
     */
    public function editStatement(StatementRequest $request, Project $project)
    {
        $this->authorize('userIsAdmin', $project);

        $project->statement_title = $request->getStatementTitle();
        $project->statement_body = $request->getStatementBody();
        $project->save();

        return back();
    }

    /**
     * Updates the custom tab title and body with what the user supplied
     *
     * @param CustomTabRequest $request
     * @param Project $project
     * @return current view
     */
    public function editCustomTab(CustomTabRequest $request, Project $project)
    {
        $this->authorize('userIsAdmin', $project);

        $project->tab_title = $request->getTabTitle();
        $project->tab_body = $request->getTabBody();
        $project->save();

        return back();
    }
}
