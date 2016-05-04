@extends('layouts.main_layout')

@section('head')
    <title>Import File | {{ $project->title }}</title>
@endsection

@section('mainBody')
    <div class="col-lg-6 col-lg-offset-3">
        @if(count($errors) > 0)
            <div class="alert alert-dismissible alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="form-horizontal" action="/editor/import/{{ $project->title }}" method="POST" enctype="multipart/form-data">
            {!! csrf_field() !!}

            <fieldset>
                <legend>Import File</legend>
                <div class="form-group">
                    <label class="control-label col-lg-2" for="fileName">File Name</label>
                    <div class="col-lg-6">
                        <input class="form-control" type="text" id="fileName" name="fileName" placeholder="File.ext" value="{{ old('fileName') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-2" for="description">Description</label>
                    <div class="col-lg-6">
                        <input class="form-control" type="text" id="description" name="description" placeholder="Description" value="{{ old('description') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-2" for="file">File</label>
                    <div class="col-lg-6">
                        <input class="form-control" type="file" id="fileImport" name="fileImport">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="submit" class="btn btn-primary">Import</button>
                        <a href="{{ back()->getTargetUrl() }}" class="btn btn-default">Cancel</a>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
@stop