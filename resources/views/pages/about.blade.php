@extends('layouts.main_layout')

@section('head')
    <title>About</title>
@endsection

@section('mainBody')
    @include('inserts.breadcrumb')
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