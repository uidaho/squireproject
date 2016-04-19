@extends('layouts.main_layout')

@section('head')
    <title>{{ $project->title }}</title>
@stop

@section('mainBody')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-md-offset-5">
                <h4>{{ $project->title }}</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="fallback-image">
                    <div class="project-image" style="background-image: url({{ $project->getImagePath() }});"></div>
                </div>
                <hr>
                <span class="label label-default project-memebers">n+1 Members</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <p class="text-left">
                    {{ $project->description }}
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                @include('project.comments')
            </div>
            <hr>
            <hr>
            <div class="col-md-10">
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