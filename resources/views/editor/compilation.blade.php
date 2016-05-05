@extends('layouts.main_layout')

@section('head')
    <title>Compilation Result</title>
@endsection

@section('mainBody')
    <div class="container compile-output">
        <pre>{{ $contents }}</pre>
        <a href="{{back()->getTargetUrl()}}">
            <button class="btn btn-primary">Return</button>
        </a>
    </div>
@stop