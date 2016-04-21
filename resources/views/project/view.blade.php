@extends('layouts.main_layout')

@section('head')
    <title>{{ $project->title }}</title>
@stop

@section('mainBody')
    @include('inserts.breadcrumb')
    <div class="container-fluid">
        <div class="row">
            <h1 class="text-center">{{ $project->title }}</h1>
            <br>
            <br>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="">
                    <img class="center-block r-image-restraint" src="{{ $project->getImagePath() }}" alt="Project Image">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <hr>
                <h4 class="visible-lg-inline">Creator: {{ $project->author }}</h4>
                <span class="label label-default project-members">n+1 Members</span>
                <div class="pull-right">
                    @if (Auth::check())
                        @if ($project->isUserFollower())
                            <a href="/project/unfollow/{{ $project->getSlugFriendlyTitle() }}">
                                <button class="btn btn-danger">Unfollow</button>
                            </a>
                        @else
                            <a href="/project/follow/{{ $project->getSlugFriendlyTitle() }}">
                                <button class="btn btn-default">Follow</button>
                            </a>
                        @endif
                    @else
                        <!-- Trigger the modal with a button -->
                        <button class="btn btn-default" data-toggle="modal" data-target="#loginForm">Follow</button>
                            <!-- Modal -->
                            <div class="modal fade" id="loginForm" role="dialog">
                                <div class="modal-dialog modal-lg">
                                    @include('auth.login_insert')
                                </div>
                            </div>
                    @endif
                    <p class="visible-lg-inline">Followers: {{ $project->getFollowerCount() }}</p>
                    @if(Session::has('follow_success') || Session::has('unfollow_success'))
                        <div class="alert alert-dismissible alert-success">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <p>{{ Session::get('follow_success') }}{{ Session::get('unfollow_success') }}</p>
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
                    <a href="/editor/{{ $project->getSlugFriendlyTitle() }}">
                        <button class="btn btn-default" id="view-files">View Files</button>
                    </a>
                    @if (Auth::user()->username == $project->author)
                        <a href="/project/delete/{{ $project->getSlugFriendlyTitle() }}">
                            <button class="btn btn-danger" id="delete">Delete</button>
                        </a>
                    @endif
                @endif
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="jumbotron">
                    <h2>
                        Description
                    </h2>
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
@stop