@extends('layouts.main_layout')

@section('head')
    <title>Home</title>
@stop

@section('mainBody')

    <section class="r-banner">
        <img class="" src="/images/test-banner.jpg" alt="Project Image">
    </section>

    <section class="row r-hide-links">
        <div class="">

            <!-- Left Gap -->
            <div class="col-md-2">
                <!-- Todo check if user is admin -->
                @if (true)
                    <!-- Pending Users -->
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
                    <!-- Todo display actual user input here -->
                    <p>{{ $project->description }}</p>
                </div>

                <!-- Member Statistics -->
                <div class="well r-member-stats">
                    <h4>Member Statistics</h4>
                    <h6>Members: {{ $project->getMemberCount() }}</h6>
                    <!-- Todo get admins count -->
                    <h6>Admins: N/A</h6>
                </div>

                <!-- Admins List -->
                <div class="well r-admin-list">
                    <h4>Admins</h4>
                    <!-- Todo display project owner's username -->
                    <h6><a href="">Creator</a></h6>
                    <!-- Todo display projects admin's usernames -->
                    @foreach($project->members as $admin)
                        <h6><a href=""></a></h6>
                    @endforeach
                </div>

            </section>

            <!-- Mid column -->
            <section class="col-md-6 r-tab-col">

                <!-- Tab Header -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#welcome" data-toggle="tab" aria-expanded="true">Welcome</a></li>
                    <li class=""><a href="#members" data-toggle="tab" aria-expanded="false">Members</a></li>
                    <li class=""><a href="#files" data-toggle="tab" aria-expanded="false">Files</a></li>
                </ul>

                <!-- Tab Container -->
                <div class="tab-content r-tab-body">

                    <!-- Welcome Tab -->
                    <section class="tab-pane fade active in" id="welcome">
                        <h1 class="text-center">Welcome</h1>
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
                                    <td>
                                        <form action="" method="GET">
                                            {!! csrf_field() !!}
                                            <button name="" type="submit" class="btn btn-xxs btn-primary pull-right" value="">
                                                Message
                                            </button>
                                        </form>
                                    </td>
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
@stop