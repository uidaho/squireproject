@extends('layouts.main_layout')

@section('head')
    <title>{{ $project->title }}</title>
@stop

@section('mainBody')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-md-offset-5">
                <h4 class="visible-lg-inline">{{ $project->title }}</h4>
                @if (Auth::check() && Auth::user()->username == $project->author)
                    <a href="/project/delete/{{ $project->title }}">
                        <button type="button" id="delete">Delete</button>
                    </a>
                @endif
                <br>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="fallback-image">
                    <div class="project-image" style="background-image: url({{ $project->getImagePath() }});"></div>
                </div>
                <hr>
                <h3>Creator: {{ $project->author }}</h3>
                <span class="label label-default project-memebers">n+1 Members</span>
                <hr>
            </div>
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
            <br>
            <br>
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
    </div>
@stop