@extends('layouts.main_layout')

@section('head')
    <title>{{$files[0]->projectname}} Project Files | The Squire Project</title>
@endsection

@section('mainBody')
@include('inserts.breadcrumb')
<div class="row">
    <div class="col-md-12">
        <!-- Search -->
        <form class="navbar-form navbar-right" role="search">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
        <!-- Toolbar -->
        <div class="btn-toolbar" role="toolbar" aria-label="File list toolbar">
            <div class="btn-group" role="group" aria-label="File command group">
                <a href="/editor/create/{{ $files[0]->projectname }}" class="btn btn-default btn-sm">
                    <em class="glyphicon glyphicon-plus"></em> Create
                </a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- Files -->
        @include('editor.filelist')
    </div>
</div>
@stop