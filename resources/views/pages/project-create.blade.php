@extends('layouts.main_layout')

@section('head')

    <title>Create Project</title>
    {{ Html::script('js/jsmain.js') }}

@endsection

@section('mainBody')

<main class="container primary-main row">
    <form role="form" class="project-form" action="{{ url('/project-create') }}" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}

        <h5>Create Project</h5>

        <!-- Thumbnail -->
        <div class="form-group">
            <label for="thumbnail">Thumbnail</label>
            <input class="form-control" type="file" id="thumbnail" name="thumbnail" value="{{old('thumbnail')}}">
            @if ($errors->has('thumbnail'))
                <span class="error-auth">{{ $errors->first('thumbnail') }}</span>
            @endif
        </div>

        <!-- Title -->
        <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control" type="text" id="title" name="title" placeholder="Your project's title" value="{{old('title')}}"
                   minlength="{{ \App\Project::attributeLengths()['title']['min'] }}" maxlength="{{ \App\Project::attributeLengths()['title']['max'] }}" onkeyup="writeCharCount('title')">
            <p id="title-count"></p>
            @if ($errors->has('title'))
                <span class="error-auth">{{ $errors->first('title') }}</span>
            @endif
        </div>

        <!-- Description -->
        <div class="form-group">
            <label for="description">Description</label>
            <input class="form-control" type="text" id="description" name="description" placeholder="A short description" value="{{old('description')}}" size="88" height="2"
                   minlength="{{ \App\Project::attributeLengths()['description']['min'] }}" maxlength="{{ \App\Project::attributeLengths()['description']['max'] }}" onkeyup="writeCharCount('description')">
            <p id="description-count"></p>
            @if ($errors->has('description'))
                <span class="error-auth">{{ $errors->first('description') }}</span>
            @endif
        </div>

        <!-- Project Body -->
        <div class="form-group">
            <label for="project-body">About The Project</label>
            <textarea class="form-control" id="project-body" name="project-body" rows="15" placeholder="All the details of your project"
                      minlength="{{ \App\Project::attributeLengths()['project-body']['min'] }}" maxlength="{{ \App\Project::attributeLengths()['project-body']['max'] }}" onkeyup="writeCharCount('project-body')">{{old('project-body')}}</textarea>
            <p id="project-body-count"></p>
            @if ($errors->has('project-body'))
                <span class="error-auth">{{ $errors->first('project-body') }}</span>
            @endif
        </div>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
        <a href="/projectfinder">
            <button type="button" class="btn btn-danger">Cancel</button>
        </a>
    </form>
</main>

@stop
