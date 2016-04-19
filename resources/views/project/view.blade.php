@extends('layouts.main_layout')

@section('head')
    <title>{{ $project->title }}</title>
@stop

@section('mainBody')
    <div class="row">
        <div class="panel-body">
            <div class="fallback-image">
                <div class="project-image" style="background-image: url({{ $project->getImagePath() }});"></div>
            </div>
            <hr/>
            <span class="label label-default project-members">n+1 Members</span>
            <h4>{{ $project->title }}</h4>
            <div class="project-description">
                {{ $project->description }}
            </div>
            <div>
                {{ $project->body }}
            </div>
            <br>
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
        <div class="col-md-6 col-md-offset-3">
            @include('project.comments')
        </div>
    </div>
@stop