@extends('layouts.main_layout')

@section('head')
    <title>{{ $project->title }}</title>
    {{ Html::script('js/jsmain.js') }}
@stop

@section('mainBody')
    @include('inserts.breadcrumb')
    <div class="container-fluid">
        <div class="row r-edit-title">
            <h1 class="text-center">{{ $project->title }}</h1>
            <!-- Trigger banner edit modal -->
            @if ($project->isUserAuthor(Auth::user()))
                <button name="title-edit" type="submit" class="btn btn-default" data-toggle="modal" data-target="#edit-title">Edit</button>
            @endif
            <br>
            <br>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="r-project-image">
                    <img class="center-block r-image-restraint" src="{{ $project->getProjectImagePath() }}" alt="Project Image">
                    <!-- Trigger banner edit modal -->
                    @if ($project->isUserAuthor(Auth::user()))
                        <button name="thumbnail-edit" type="submit" class="btn btn-default" data-toggle="modal" data-target="#edit-thumbnail">Edit</button>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <hr>
                <h4 class="visible-lg-inline">Creator: {{ $project->author }}</h4>
                <span class="label label-default project-members">Members: {{ $project->getMemberCount() }}</span>
                <div class="pull-right">
                        @if (Auth::check() && Auth::user()->username != $project->author)

                            @if ($project->isUserMember())
                                <form class="r-inline" action="/project/leave/{{ $project->title }}" method="GET">
                                    <button name="member-remove" class="btn btn-danger">Leave Project</button>
                                </form>
                            @elseif ($project->isMembershipPending())
                                <form class="r-inline" action="/project/request/cancel/{{ $project->title }}" method="GET">
                                    <button name="member-add" class="btn btn-warning">Cancel Join Request</button>
                                </form>
                            @else
                                <form class="r-inline" action="/project/request/join/{{ $project->title }}" method="GET">
                                    <button name="member-add" class="btn btn-default">Join Project</button>
                                </form>
                            @endif

                            @if ($project->isUserFollower())
                                <form class="r-inline" action="/project/unfollow/{{ $project->title }}" method="GET">
                                    <button name="follow-remove" class="btn btn-danger">Unfollow</button>
                                </form>
                            @else
                                <form class="r-inline" action="/project/follow/{{ $project->title }}" method="GET">
                                    <button name="follow-add" class="btn btn-default">Follow</button>
                                </form>
                            @endif

                        @elseif (Auth::guest())
                            <!-- Trigger the modal with a button -->
                            <button name="member-login" class="btn btn-default" data-toggle="modal" data-target="#loginForm">Join Project</button>
                            <!-- Trigger the modal with a button -->
                            <button name="follow-login" class="btn btn-default" data-toggle="modal" data-target="#loginForm">Follow</button>
                                <!-- Modal -->
                                <div class="modal fade" id="loginForm" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                        @include('auth.login_insert')
                                    </div>
                                </div>
                        @endif
                    <p class="visible-lg-inline">Followers: {{ $project->getFollowerCount() }}</p>
                    @if(Session::has('follower_success')||Session::has('member_success')||Session::has('membership_request_success'))
                        <div class="alert alert-dismissible alert-success">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <p>{{ Session::get('follower_success') }}{{ Session::get('member_success') }}{{ Session::get('membership_request_success') }}</p>
                        </div>
                    @endif
                </div>
                <hr>
            </div>
            <br>
            <br>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                @if (Auth::check())
                    @if ($project->isUserMember())
                        <a href="/project/private/{{ $project->title }}">
                            <button class="btn btn-default" id="members-button">Members Page</button>
                        </a>
                    @endif
                    @if (Auth::user()->username == $project->author)
                        <a href="/project/delete/{{ $project->title }}">
                            <button class="btn btn-danger" id="delete">Delete</button>
                        </a>
                    @endif
                @endif
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="jumbotron r-bound r-edit-body">
                    <h2>
                        Description
                    </h2>
                    @if ($project->isUserAuthor(Auth::user()))
                        <button name="body-edit" type="submit" class="btn btn-default" data-toggle="modal" data-target="#edit-body">Edit</button>
                    @endif
                    <p>
                        {{ $project->body }}
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                @include('project.comments')
            </div>
        </div>
    </div>

    <!-- Modals Section -->
    <section>

        <!-- Image Modal -->
        <div class="modal fade" id="edit-thumbnail" role="dialog">
            <div class="modal-dialog modal-lg">
                @include('project.edit.image')
            </div>
        </div>

        <!-- Title Modal -->
        <div class="modal fade" id="edit-title" role="dialog">
            <div class="modal-dialog modal-lg">
                @include('project.edit.title')
            </div>
        </div>

        <!-- Body Modal -->
        <div class="modal fade" id="edit-body" role="dialog">
            <div class="modal-dialog modal-lg">
                @include('project.edit.body')
            </div>
        </div>

    </section>
@stop