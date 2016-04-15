@extends('layouts.main_layout')

@section('head')
    <title>{{$projectname}} Create File | The Squire Project</title>
@endsection

@section('mainBody')
    <main class="container primary-main row">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form role="form" class="project-form" action="{{ url('/editor/create/'.$projectname) }}" method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}

            <h5>Create File</h5>
            <div class="form-group">
                <label for="title">Name</label>
                <input class="form-control" type="text" id="filename" name="filename" placeholder="filename.txt">
                @foreach ($errors->get('filename') as $error)
                    <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        {{$error}}
                    </div>
                @endforeach
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input class="form-control" type="text" id="description" name="description" placeholder="A short description" maxlength="100" size="88" height="2">
                @foreach ($errors->get('description') as $error)
                    <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        {{$error}}
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="/editor/{{$projectname}}">
                <button type="button" class="btn btn-danger">Cancel</button>
            </a>
        </form>
    </main>
@stop