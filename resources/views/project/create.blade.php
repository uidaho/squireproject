@extends('layouts.main_layout')

@section('head')
    <title>Create Project</title>
    {{ Html::script('js/jsmain.js') }}

@endsection

@section('mainBody')
@include('inserts.breadcrumb')
<main class="container primary-main row">
    <div class="col-md-12">

        @if(count($errors) > 0)
            <div class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Could not submit.</strong> See errors below.
            </div>
        @endif

        <form class="form-horizontal" role="form" action="{{ url('/project/create') }}" method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}

            <fieldset>
                <legend>Create Project</legend>

                <!-- Project Public Page -->
                <section>
                    <legend class="r-legend-sub">Public Page <small>(Info will be displayed to everyone on Squire)</small></legend>
                    <div class="form-group">
                        @if($errors->has('thumbnail'))
                            <div class="has-error">
                        @endif

                        <label for="thumbnail" class="col-lg-2 control-label">Thumbnail</label>
                        <div class="col-lg-10">
                            <input class="form-control" type="file" id="thumbnail" name="thumbnail" value="{{ old('thumbnail') }}}">
                        </div>

                        @if($errors->has('thumbnail'))
                            <label class="control-label col-lg-10">
                                {{ $errors->first('thumbnail') }}
                            </label>
                            </div>
                        @endif

                    </div>

                    <div class="form-group">
                        @if($errors->has('title'))
                            <div class="has-error">
                        @endif
                        <label for="title" class="col-lg-2 control-label">
                            Title
                        </label>
                        <div class="col-lg-10">
                            <input class="form-control" type="text" id="title" name="title" value="{{old('title')}}" minlength="{{ \App\Project::attributeLengths()['title']['min'] }}" maxlength="{{ \App\Project::attributeLengths()['title']['max'] }}" onkeyup="writeCharCount('title')">
                            <p id="title-count"></p>
                        </div>
                        @if($errors->has('title'))
                            <label class="control-label col-lg-10">
                                {{ $errors->first('title') }}
                            </label>
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <!-- Todo fix weird error if statements and div tags -->
                        @if($errors->has('description'))
                            <div class="has-error">
                        @endif

                        <label for="description" class="col-lg-2 control-label">
                            Description
                        </label>
                        <div class="col-lg-10">
                            <input class="form-control" type="text" id="description" name="description" value="{{ old('description') }}" size="88" height="2"
                                   minlength="{{ \App\Project::attributeLengths()['description']['min'] }}" maxlength="{{ \App\Project::attributeLengths()['description']['max'] }}" onkeyup="writeCharCount('description')">
                            <p id="description-count"></p>
                        </div>

                        @if($errors->has('description'))
                            <label class="control-label col-lg-10">
                                {{ $errors->first('description') }}
                            </label>
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        @if($errors->has('project-body'))
                            <div class="has-error">
                        @endif

                        <label for="project-body" class="col-lg-2 control-label">
                            About The Project
                        </label>
                        <div class="col-lg-10">
                            <textarea class="form-control" id="project-body" name="project-body" rows="10" minlength="{{ \App\Project::attributeLengths()['project-body']['min'] }}" maxlength="{{ \App\Project::attributeLengths()['project-body']['max'] }}" onkeyup="writeCharCount('project-body')">{{old('project-body')}}</textarea>
                            <p id="project-body-count"></p>
                        </div>

                        @if($errors->has('project-body'))
                            <label class="control-label col-lg-10">
                                {{ $errors->first('project-body') }}
                            </label>
                            </div>
                        @endif
                    </div>
                </section>

                <!-- Buttons Area -->
                <section class="r-create-buttons">
                    <button type="submit" id="submit" class="btn btn-default">Submit</button>
                    <a href="{{ back()->getTargetUrl() }}">
                        <button type="button" class="btn btn-danger">Cancel</button>
                    </a>
                </section>

            </fieldset>
        </form>
    </div>
</main>
@stop
