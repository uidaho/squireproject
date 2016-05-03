@extends('layouts.main_layout')

@section('head')
    <title>{{$user->username}}s Profile</title>
@endsection

@section('mainBody')
    @include('inserts.breadcrumb')
    <div class="container-fluid well">
        <legend>Profile</legend>
        <div class="row">
		    <div class="col-md-2">
				<img class="center-block" scr={{$user->profile->profile_url}} >
		    	<div class="">
					<h2 class="center"> {{$user->username}}</h2>
					@if ($user->username != Auth::user()->username)
						<div class="btn-group btn-group-justified">
			        	<a href="#" class="btn btn-default">Send Message</a>
			        	<a href="#" class="btn btn-default">Add To Contact</a>
			    		</div>
					@endif
					
				</div>
			</div>
			<div class="col-md-10">
		    	<div class="col-md-6">
		        	<h4>Basic Information</h4>
		            <label>Name:</label><p>{{$user->profile->first_name}} {{$user->profile->last_name}}</p><br/>
		            <label>Birth Date:</label><p>{{$user->profile->date_of_birth}}</p><br/>
		            <label>Gender:</label>
					@if ($user->profile->gender)<p>Male</p> 
					@else <p>Female</p> 
					@endif<br/>
				</div>
				<div class="col-md-6">
		            <h4>Contact Information</h4>
		            <label>Email:</label><p>{{$user->email}}</p><br/>
		            <label>Phone:</label><p>{{$user->profile->phone}}</p><br/>
		            <label>Address:</label><p>{{$user->profile->address}}</p><br/>
				</div>
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">About Me</div>
						<div class="panel-body"><p>{{$user->profile->biography}}</p></div>
					</div>	
				<div/>
			<div/>
		<div/>
				<a href="/editprofile/{{$user->id}}">Edit Profile</a>
                    		<a href="/profileprojects">User Projects</a>
    </div>
@stop
