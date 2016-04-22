@extends('layouts.main_layout')

@section('head')
    <title>Forbidden (403) | The Squire Project</title>
@stop

@section('mainBody')
    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10 text-center">
            <h5 class="title">Forbidden (403)</h5>
            <iframe src="//giphy.com/embed/njYrp176NQsHS" width="1200" height="500" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>
            <p class="hidden"><a href="http://giphy.com/gifs/lotr-gandalf-lord-of-the-rings-njYrp176NQsHS">via GIPHY</a></p>
            <!--<img alt="403" src="/images/errors/403.jpg">-->
            <blockquote>
                <h1><strong>You Shall Not Pass!</strong></h1>
                <small>by <cite>Gandalf</cite></small>
            </blockquote>
        </div>
        <div class="col-md-1">
        </div>
    </div>
@stop