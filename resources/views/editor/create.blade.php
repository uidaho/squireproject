@extends('layouts.main_layout')

@section('head')
    <title>{{$projectname}} Create File | The Squire Project</title>
@endsection

@section('mainBody')
@include('inserts.breadcrumb')
<div class="row">
    <div class="col-md-12">
        <form role="form" class="form-horizontal" action="{{ url('/editor/create/'.$projectname) }}" method="post" enctype="multipart/form-data">
          <fieldset>
            <legend>Create a new file in {{ $projectname }}</legend>
            <div class="form-group">
              <label for="filename" class="col-lg-2 control-label">File name</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="filename" name="filename" placeholder="filename.txt">
                @foreach ($errors->get('filename') as $error)
                    <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        {{$error}}
                    </div>
                @endforeach
              </div>
            </div>
            <div class="form-group">
              <label for="description" class="col-lg-2 control-label">Description</label>
              <div class="col-lg-10">
                <textarea class="form-control" rows="3" id="description" name="description" maxlength="255"></textarea>
                @foreach ($errors->get('description') as $error)
                    <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        {{$error}}
                    </div>
                @endforeach
                <span class="help-block">A short description helps others understand what the file is used for without opening it.</span>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-2 control-label">Type</label>
              <div class="col-lg-10">
                <div class="radio">
                  <label>
                    <input type="radio" name="type" id="type" value="file" checked="">
                    File
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="type" id="type2" value="directory">
                    Directory
                  </label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-lg-10 col-lg-offset-2">
                <a href="{{ back()->getTargetUrl() }}">
                    <button type="button" class="btn btn-danger">Cancel</button>
                </a>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
            {!! csrf_field() !!}
          </fieldset>
        </form>
    </div>
</div>
@stop