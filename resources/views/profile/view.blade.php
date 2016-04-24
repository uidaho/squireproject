@extends('layouts.main_layout')

@section('head')
    <title>{{$username}}s Profile</title>
@endsection

@section('mainBody')
    @include('inserts.breadcrumb')
    <div class="row">
        <div class="col-md-12">
            <legend>Profile</legend>
                <div class="row">
                <div class="p-col-1-3">
                    <img class="center-block" scr="images/projects/DefaultProfile.jpg" style="height:175px;width:250px;">
                <div class="p-center">
                    <a class="center" class="username-btn">{{ Auth::user()->username }}</a>
                    <a href="#" class="btn btn-warning">Send Message</a>
                    <a href="#" class="btn btn-primary">Add To Contact</a>
                </div>
                </div>
                <div class="p-col-2-3">
                    <h4>Basic Information</h4>
                    <label>User name:</label><a class="username-btn">{{ Auth::user()->username }}</a>
                    <label>Birth Date:</label><a class="username-btn">{{ Auth::user()->username }}</a>
                    <label>Gender:</label><a class="username-btn">{{ Auth::user()->username }}</a>
                    <h4>Contact Information</h4>
                    <label>Email:</label><a class="username-btn">{{ Auth::user()->username }}</a>
                    <label>Phone:</label><a class="username-btn">{{ Auth::user()->username }}</a>
                    <label>Address:</label><a class="username-btn">{{ Auth::user()->username }}</a>
                    <h4>About Me</h4>
            </div>
            </div>
	        <!-- Template: http://wrapbootstrap.com/preview/WB09JXK43 -->
        </div>
    </div>
@stop
