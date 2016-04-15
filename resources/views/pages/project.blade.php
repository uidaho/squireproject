@extends('layouts.main_layout')

@section('head')

    <title>{{ $project->title }}</title>

@stop

@section('mainBody')
    <main class="container project-page">
        <div class="row">
            <div class="col-1-2">
                <img src="{{ $project->getImagePath() }}" alt="Project Image" border="1px">
            </div>
            <div class="col-1-2">
                <h5>{{ $project->title }} by {{ $project->author  }}</h5>
                <h4>{{ $project->description }}</h4>
            </div>
            <div class="project-page-elements">
                <pre style="white-space: pre-wrap">{{ $project->body }}</pre>
            </div>
            @if (Auth::check() && Auth::user()->username == $project->author)
            <div class="project-page-elements">
                <a href="{{ $project->getSlug() }}/delete">
                    <button type="button" id="delete">Delete</button>
                </a>
            </div>
            @endif
        </div>
    </main>
@stop