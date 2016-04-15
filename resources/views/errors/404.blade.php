@extends('layouts.main_layout')

@section('head')
    <title>Page Not Found (404) | The Squire Project</title>

    <style>
        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 72px;
            margin-bottom: 40px;
        }
    </style>
@stop

@section('mainBody')
    <div class="container">
        <div class="content">
            <img alt="404" src="/images/errors/404.jpg">
            <div class="title">Page Not Found (404)</div>
            <strong>Unfortunately, the page you requested does not exist on our site.</strong>
        </div>
    </div>
@stop


