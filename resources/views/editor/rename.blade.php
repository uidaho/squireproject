@extends('layouts.main_layout')

@section('head')
    <title>Compilation Result</title>
@endsection

@section('mainBody')
    <pre>{{ $contents }}</pre>
    <a href="{{back()->getTargetUrl()}}">
        <button class="btn btn-primary">Return</button>
    </a>
@stop