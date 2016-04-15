@extends('layouts.main_layout')

@section('head')

    <title>Create Project</title>

@endsection

@section('mainBody')

<main class="container primary-main row">
    <form role="form" class="project-form" action="{{ url('/create') }}" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}

        <h5>Create Project</h5>
        <div class="form-group">
            <label for="thumbnail">Thumbnail</label>
            <input class="form-control" type="file" id="thumbnail" name="thumbnail">
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control" type="text" id="title" name="title" placeholder="Your project's title">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input class="form-control" type="text" id="description" name="description" placeholder="A short description" maxlength="100" size="88" height="2">
        </div>
        <div class="form-group">
            <label for="project-body">About The Project</label>
            <textarea class="form-control" id="project-body" name="project-body" rows="15" placeholder="All the details of your project"></textarea>
        </div>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
        <a href="/projectfinder">
            <button type="button" class="btn btn-danger">Cancel</button>
        </a>
    </form>
</main>

@stop