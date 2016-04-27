@extends('layouts.main_layout')

@section('head')
    <title>Compilation</title>
@endsection

@section('mainBody')
    <div class="container compile-output">
        @if ($output)
            <p class="lead">There was a problem during compilation.</p>
            <pre>{!! $output !!}</pre>
            <a href="{{ back()->getTargetUrl() }}">
                <button type="button" class="btn btn-danger">Return</button>
            </a>
        @else
            <p class="lead">Compilation successful.</p>
            <div class="btn-group">
                <a href="{{ url('/editor/downloadCompilation/' . $file->projectname . '/' . $file->filename . '/' . $key) }}">
                    <button type="button" class="btn btn-success">Download</button>
                </a>
                <a href="{{ back()->getTargetUrl() }}">
                    <button type="button" class="btn btn-danger">Return</button>
                </a>
            </div>
        @endif
    </div>
@stop