@extends('layouts.main_layout')

@section('head')

    <title>{{ $project->title }}</title>

@stop

@section('mainBody')
    <main class="container">
        <div class="project-page">
            <img src="/images/projects/product{{ $project->id }}.jpg" alt="Project Image" width="50%" height=50% border="1px">
            <h4 style="clear:left">{{ $project->title }} by {{ $project->author  }}</h4>
            <p>{{ $project->description }}</p>
        </div>
    </main>
@stop