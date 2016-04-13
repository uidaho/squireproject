@extends('layouts.main_layout')

@section('head')
    <title>Delete {{$file->projectname}}/{{$file->filename}}? | The Squire Project</title>
@endsection

@section('mainBody')
    <main class="container editor">
        <div class="row">
            <h4>Are you sure you want to delete {{$file->projectname}}/{{$file->filename}}?</h4>
        </div>
        <div class="row">
            <div class="project-page-elements">
                <a href="/editor/delete/{{$file->projectname}}/{{$file->filename}}">
                    <button type="button" id="delete">YES</button>
                </a>
                <a href="/editor/{{$file->projectname}}">
                    <button type="button" id="delete">NO</button>
                </a>
            </div>
        </div>
    </main>
@stop