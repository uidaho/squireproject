@extends('layouts.main_layout')

@section('head')
    <title>{{ $project->title }}</title>
@stop

@section('mainBody')
    <div class="row">
        <div class="col-md-12">
            <img src="/images/projects/product{{ $project->id }}.jpg" alt="Project Image" border="1px">
            <h5>{{ $project->title }} by {{ $project->author  }}</h5>
            <h4>{{ $project->description }}</h4>
            <div class="jumbotron well">
                {{ $project->body }}
            </div>
            @if (Auth::check() && Auth::user()->username == $project->author)
                <a href="{{ $project->getSlug() }}/delete">
                    <button type="button" id="delete">Delete</button>
                </a>
            @endif
            @if (Auth::check())
                <a href="/editor/{{ $project->title }}">
                    <button type="button" id="viewfiles">View Files</button>
                </a>
            @endif
        </div>
    </div>
@stop