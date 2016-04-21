@extends('layouts.main_layout')

@section('head')
    <title>About</title>
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li>
            <a href="/">Home</a>
        </li>
        @for($i = 1; $i <= count(Request::segments()); $i++)
            <li @if($i == count(Request::segments())) class="active" @endif>
                <a href="@for($j = 1; $j <= $i; $j++)/{{ Request::segment($j) }}@endfor">{{ Request::segment($i) }}</a>
            </li>
        @endfor
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