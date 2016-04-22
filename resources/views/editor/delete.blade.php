@extends('layouts.main_layout')

@section('head')
    <title>Delete {{$projectname}}/{{$filename}}? | The Squire Project</title>
@endsection

@section('mainBody')
    @include('inserts.breadcrumb')
    <div class="row">
        <div class="col-md-12">
            <form role="form" class="form-horizontal" action="{{ url('/editor/delete/'.$projectname.'/'.$filename) }}" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Are you sure you want to delete {{$projectname}}/{{$filename}}?</legend>
                    <div class="form-group">
                        <div class="col-lg-10">
                            Warning, this is unrecoverable at this time!
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <a href="/editor/{{$projectname}}" class="btn btn-default btn-lg">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-lg">Delete</button>
                        </div>
                    </div>
                    {!! csrf_field() !!}
                </fieldset>
            </form>
        </div>
    </div>
@stop