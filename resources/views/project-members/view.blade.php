@extends('layouts.main_layout')

@section('head')
    <title>Home</title>
@stop

@section('mainBody')

    <section class="r-banner">
        <img class="" src="{{ $project->getBannerImagePath() }}" alt="Project Image">
        <!-- Trigger banner edit modal -->
        <button name="banner-edit" type="submit" class="btn btn-default admin-only" data-toggle="modal" data-target="#edit-banner">Edit</button>
    </section>

    <section class="row r-hide-links">
        <div class="">

            <!-- Left Gap -->
            <div class="col-md-2">
                <!-- Pending Users-->
                @if ($project->requests != null && $project->isProjectAdmin())
                    <div class="well r-pending-users">
                        <h4>Requests to Join the Project</h4>
                        <table class="table table-striped table-hover ">
                            <thead>
                            <tr>
                                <th>Username</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($project->requests as $joinRequest)
                                <tr class="info">
                                    <td>{{ $joinRequest->user->username }}</td>
                                    <td>
                                        <form action="project/request/accepted/{{ $project->getSlugFriendlyTitle() }}/{{ $joinRequest->user->id }}" method="POST">
                                            {!! csrf_field() !!}
                                            <button name="request-accepted" type="submit" class="btn btn-xxs btn-primary" value="Add User">
                                                Add
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="project/request/denied/{{ $project->getSlugFriendlyTitle() }}/{{ $joinRequest->user->id }}" method="POST">
                                            {!! csrf_field() !!}
                                            <button name="request-denied" type="submit" class="btn btn-xxs btn-danger" value="Deny User">
                                                Deny
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <!-- Left column -->
            <section class="col-md-2">
                <!-- Mission Statement -->
                <div class="well r-description">
                    <h4>Mission Statement</h4>
                    <button name="statement-edit" type="submit" class="btn btn-xs btn-default admin-only" data-toggle="modal" data-target="#edit-statement">Edit</button>
                    <!-- Todo display actual user input here -->
                    <p>{{ $project->statement }}</p>
                </div>

                <!-- Member Statistics -->
                <div class="well r-member-stats">
                    <h4>Member Statistics</h4>
                    <p>Members: {{ $project->getMemberCount() }}</p>
                    <!-- Todo get admins count -->
                    <p>Admins: {{ $project->getAdminCount() }}</p>
                </div>

                <!-- Admins List -->
                <div class="well r-admin-list">
                    <h4>Admins</h4>
                    <div class="r-admin-list-creator">
                        <p class="r-username"><a href="">{{ $project->author }}</a></p>
                        <p>Creator</p>
                    </div>
                    @foreach($project->getAdmins() as $admin)
                        @if ($admin->user->id != $project->user->id)
                            <p class="r-username"><a href="">{{ $admin->user->username }}</a></p>
                        @endif
                    @endforeach
                </div>

            </section>

            <!-- Mid column -->
            <section class="col-md-6 r-tab-col">

                <!-- Tab Header -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#custom-tab" data-toggle="tab" aria-expanded="true">{{ $project->tab_title }}</a></li>
                    <li class=""><a href="#members" data-toggle="tab" aria-expanded="false">Members</a></li>
                    <li class=""><a href="#files" data-toggle="tab" aria-expanded="false">Files</a></li>
                </ul>

                <!-- Tab Container -->
                <div class="tab-content r-tab-body">

                    <!-- Custom User Tab -->
                    <section class="tab-pane fade active in" id="custom-tab">
                        <div class="r-edit-container">
                            <h1>{{ $project->tab_title }}</h1>
                            <button name="customtab-edit" type="submit" class="btn btn-xs btn-default admin-only" data-toggle="modal" data-target="#edit-customtab">Edit</button>
                        </div>
                        <p>{{ $project->tab_body }}</p>
                    </section>

                    <!-- Members Tab -->
                    <section class="col-md-3 tab-pane fade" id="members">
                        <table class="table table-striped table-hover r-member-table">
                            <thead>
                                <h1>Members</h1>
                            </thead>
                            <tbody>
                            @foreach($project->members as $member)
                                <tr class="info">
                                    <!-- Todo add link to user's profile -->
                                    <td><a href="">{{ $member->user->username }}</a></td>
                                    @if ($project->isProjectAdmin())
                                        <td>
                                            @if (!$member->admin)
                                                <form action="/project/promote/{{ $project->getSlugFriendlyTitle() }}/{{ $member->id }}" method="POST">
                                                    {!! csrf_field() !!}
                                                    <button name="make-admin" type="submit" class="btn btn-xxs btn-primary pull-right" value="make-admin">
                                                        Make Admin
                                                    </button>
                                                </form>
                                            @endif
                                            @if ($project->isUserAuthor(Auth::user()) && $member->admin && Auth::user()->id != $member->user_id)
                                                <form action="/project/demote/{{ $project->getSlugFriendlyTitle() }}/{{ $member->id }}" method="POST">
                                                    {!! csrf_field() !!}
                                                    <button name="remove-admin" type="submit" class="btn btn-xxs btn-danger pull-right" value="remove-admin">
                                                        Remove Admin
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </section>

                    <!-- Files Tab -->
                    <section class="tab-pane fade" id="files">
                        @include('editor.filelist')
                    </section>

                </div>

            </section>

            <!-- Right Gap -->
            <div class="col-md-2">
            </div>

        </div>

    </section>

    <!-- Modals Section -->
    <section>

        <!-- Banner Modal -->
        <div class="modal fade" id="edit-banner" role="dialog">
            <div class="modal-dialog modal-lg">
                @include('project-members.edit.banner')
            </div>
        </div>

        <!-- Statement Modal -->
        <div class="modal fade" id="edit-statement" role="dialog">
            <div class="modal-dialog modal-lg">
                @include('project-members.edit.statement')
            </div>
        </div>

        <!-- Custom Tab Modal -->
        <div class="modal fade" id="edit-customtab" role="dialog">
            <div class="modal-dialog modal-lg">
                @include('project-members.edit.customtab')
            </div>
        </div>

    </section>

    <script>
        var isAdmin = "<?php echo $project->isProjectAdmin(); ?>";

        //Hide edit buttons from non-admins
        function hideEditButtons() {
            if (!isAdmin) {
                var items = document.getElementsByClassName('admin-only');

                for (var i = 0; i < items.length; i++)
                {
                    items[i].style.visibility = 'hidden';
                }
            }
        }

        window.onload = hideEditButtons();
    </script>
@stop