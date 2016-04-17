@extends('layouts.main_layout')

@section('head')
    <title>{{ $project->title }}</title>
@stop

@section('mainBody')
    <div class="row">
        <div class="col-md-2">
            <div class="panel-body">
                <div class="fallback-image">
                    <div class="project-image" style="background-image: url({{ $project->getImagePath() }});"></div>
                </div>
                <hr/>
                <span class="label label-default project-memebers">n+1 Members</span>
                <h4>{{ $project->title }}</h4>
                <div class="project-description">
                    {{ $project->description }}
                </div>
                @if (Auth::check() && Auth::user()->username == $project->author)
                    <a href="{{ $project->getSlug() }}/delete">
                        <button type="button" id="delete">Delete</button>
                    </a>
                @endif
            </div>
        </div>
        <div class="col-md-10">
            @if (Auth::check())
                <a href="/editor/create/{{ $project->title }}" class="btn btn-default btn-sm">
                    <em class="glyphicon glyphicon-plus"></em> Create
                </a>
                @include('editor.filelist')
            @else
                @{{ tetris here }}
            @endif
        </div>
    </div>
@stop