@extends('layouts.main_layout')

@section('head')
    <title>Page Not Found (404) | The Squire Project</title>
@stop

@section('mainBody')
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <img alt="404" src="/images/errors/404.jpg">
                <div class="title">Page Not Found (404)</div>
                <strong>Unfortunately, the page you requested does not exist on our site.</strong>
            </div>
        </div>
    </div>
@stop


