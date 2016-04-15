@extends('layouts.main_layout')

@section('head')
    <title>Create Project</title>
@endsection

@section('mainBody')
<div class="row">
    <div class="col-md-12">
        <h5>Create Project</h5>
        <form role="form" action="{{ url('/create') }}" method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="thumbnail">
                    Thumbnail image
                </label>
                <input type="file" id="thumbnail" />
                <!-- <p class="help-block">
                    Error here
                </p> -->
            </div>
            <div class="form-group">
                <label for="title">
                    Title
                </label>
                <input type="text" class="form-control" id="title" />
                <!-- <p class="help-block">
                    Error here
                </p> -->
            </div>
            <div class="form-group">
                <label for="description">
                    Description
                </label>
                <input type="text" class="form-control" id="description" maxlength="100" size="88" height="2" />
                <!-- <p class="help-block">
                    Error here
                </p> -->
            </div>
            <div class="form-group">
                <label for="project-body">
                    About The Project
                </label>
                <textarea class="form-control" id="project-body" rows="15" placeholder="All the details of your project"></textarea>
                <!-- <p class="help-block">
                    Error here
                </p> -->
            </div>
            <button type="submit" class="btn btn-default">
                Submit
            </button>
            <a href="/projectfinder">
                <button type="button" class="btn btn-danger">
                    Cancel
                </button>
            </a>
        </form>
    </div>
</div>
@stop