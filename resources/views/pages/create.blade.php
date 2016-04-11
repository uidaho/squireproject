@extends('layouts.main_layout')

@section('head')

    <title>Create Project</title>

@endsection

@section('mainBody')

<main class="container primary-main">
    <form role="form" class="project-form" action="{{ url('/create') }}" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}

        <h5>Create Project</h5>
        <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control" type="text" id="title" name="title" placeholder="Your Project's Title">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" cols="50" placeholder="About your project"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</main>

@stop