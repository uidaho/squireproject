@extends('layouts.main_layout')

@section('head')
    <title>About</title>
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li>
            <a href="/">Home</a>
        </li>
        <div class="jumbotron">
            <h2>About us?</h2>
            <p>
                We are a group of Computer Science 383 students at the University of Idaho tasked with creating a collaborative IDE.
            </p>
        </div>
    </ul>
@endsection

@section('mainBody')
    <div class="row">
        <div class="col-md-12">
            <div id="editor">some text</div>
            <script src="src/ace.js" type="text/javascript" charset="utf-8"></script>
            <script>
                var editor = ace.edit("editor");
            </script>
        </div>
    </div>
@stop