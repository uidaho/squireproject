@extends('layouts.main_layout')

@section('head')
    <title>{{$file->projectname}} Create File | The Squire Project</title>
@endsection

@section('mainBody')
    <main class="container primary-main row">
        <form role="form" class="project-form" action="{{ url('/editor/create/'.$file->projectname) }}" method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}

            <h5>Create File</h5>
            <div class="form-group">
                <label for="title">Name</label>
                <input class="form-control" type="text" id="filename" name="filename" placeholder="filename.txt">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input class="form-control" type="text" id="description" name="description" placeholder="A short description" maxlength="100" size="88" height="2">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="/editor/{{$file->projectname}}">
                <button type="button" class="btn btn-danger">Cancel</button>
            </a>
        </form>
    </main>
@stop