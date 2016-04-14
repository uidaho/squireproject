@extends('layouts.main_layout')

@section('head')

    <title>{{ $project->title }}</title>
    <!-- Using this style sheet for now for simplicity since are going to be changing stylesheets soon any ways  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

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
            <div class="project-page-elements">
                <pre style="white-space: pre-wrap">{{ $project->body }}</pre>
            </div>
            @if (Auth::check() && Auth::user()->username == $project->author)
                <div class="project-page-elements">
                    <a href="/delete-project/{{ $project->id }}">
                        <button type="button" id="delete">Delete</button>
                    </a>
                </div>
            @endif

            <div class="col-md-6 col-md-offset-3">
                <br>
                <h6>Comments</h6>

                <ul class="list-group">
                    @foreach($project->comments as $comment)
                        <li class="list-group-item">{{ $comment->body }} <br> Created at: {{ $comment->created_at }}</li>
                    @endforeach
                </ul>

                <h6>Add a Comment</h6>

                <form class="form-group" method="POST" action="/project/{{ $project->id }}/comments">
                    <textarea class="form-control" name="comment"></textarea>

                    <input class="btn btn-primary" type="submit" name="submit" value="Send">
                </form>

            </div>

        </div>
    </main>
@stop