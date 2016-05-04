@extends('layouts.main_layout')

@section('head')
    <title>Rename '{{ $projectname }}/{{ $filename }}' | The Squire Project</title>
@endsection

@section('mainBody')
@include('inserts.breadcrumb')
<div class="row">
    <div class="col-md-12">
        <form role="form" class="form-horizontal" action="{{ url('/editor/rename/' . $projectname . '/' . $filename) }}" method="post" enctype="multipart/form-data">
          <fieldset>
            <legend>Rename '{{ $projectname }}/{{ $filename }}'</legend>
            <div class="form-group">
              <label for="filename" class="col-lg-2 control-label">New file name</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="filename" name="filename" placeholder="filename.txt" value="@if(old('filename')){{ old('filename') }}@else{{ $filename }}@endif">
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
              <label for="description" class="col-lg-2 control-label">New description</label>
              <div class="col-lg-10">
                <textarea class="form-control" rows="3" id="description" name="description" maxlength="255">@if(old('description')) {{ old('description') }} @else {{ $description }} @endif</textarea>
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
