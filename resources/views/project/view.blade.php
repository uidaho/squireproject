@extends('layouts.main_layout')

@section('head')
    <title>{{ $project->title }}</title>
@stop

@section('mainBody')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-md-offset-5">
                <h4 class="visible-lg-inline">{{ $project->title }}</h4>
                <br>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="fallback-image">
                    <div class="project-image" style="background-image: url({{ $project->getImagePath() }});"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <hr>
                <h3 class="visible-lg-inline">Creator: {{ $project->author }}</h3>
                <span class="label label-default project-members">n+1 Members</span>
                <div class="pull-right">
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
                <hr>
            </div>
            <br>
            <br>
        </div>
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