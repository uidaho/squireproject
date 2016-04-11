@extends('layouts.main_layout')

@section('head')

    <title>{{ $project->title }}</title>

@stop

@section('mainBody')
    <main class="container project-page">
        <div class="row">
            <div class="col-1-2">
                <img src="/images/projects/product{{ $project->id }}.jpg" alt="Project Image" border="1px">
            </div>
            <div class="col-1-2">
                <h5>{{ $project->title }} by {{ $project->author  }}</h5>
                <h4>{{ $project->description }}</h4>
            </div>
            <div class="project-page-text">
                <pre style="white-space: pre-wrap">{{ $project->body }}</pre>
            </div>
        </div>
    </main>
@stop