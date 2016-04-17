@extends('layouts.main_layout')

@section('head')
    <title>Create Project</title>
    {{ Html::script('js/jsmain.js') }}

@endsection

@section('mainBody')
<div class="row">
    <div class="col-md-12">
        <h5>Create Project</h5>
        <form role="form" action="{{ url('/project/create') }}" method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="thumbnail">
                    Thumbnail image
                </label>
                <input class="form-control" type="file" id="thumbnail" name="thumbnail" value="{{old('thumbnail')}}">
                @if ($errors->has('thumbnail'))
                    <p class="help-block">{{ $errors->first('thumbnail') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="title">
                    Title
                </label>
                <input class="form-control" type="text" id="title" name="title" placeholder="Your project's title" value="{{old('title')}}"
                       minlength="{{ \App\Project::attributeLengths()['title']['min'] }}" maxlength="{{ \App\Project::attributeLengths()['title']['max'] }}" onkeyup="writeCharCount('title')">
            @if ($errors->has('title'))
                    <p class="help-block">{{ $errors->first('title') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="description">
                    Description
                </label>
                <input class="form-control" type="text" id="description" name="description" placeholder="A short description" value="{{old('description')}}" size="88" height="2"
                       minlength="{{ \App\Project::attributeLengths()['description']['min'] }}" maxlength="{{ \App\Project::attributeLengths()['description']['max'] }}" onkeyup="writeCharCount('description')">
                @if ($errors->has('description'))
                    <p class="help-block">{{ $errors->first('description') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="project-body">
                    About The Project
                </label>
                <textarea class="form-control" id="project-body" name="project-body" rows="15" placeholder="All the details of your project"
                          minlength="{{ \App\Project::attributeLengths()['project-body']['min'] }}" maxlength="{{ \App\Project::attributeLengths()['project-body']['max'] }}" onkeyup="writeCharCount('project-body')">{{old('project-body')}}</textarea>
                @if ($errors->has('project-body'))
                    <p class="help-block">{{ $errors->first('project-body') }}</p>
                @endif
            </div>
            <button type="submit" class="btn btn-default">
                Submit
            </button>
            <a href="/projects">
                <button type="button" class="btn btn-danger">
                    Cancel
                </button>
            </a>
        </form>
    </div>
</div>
@stop
