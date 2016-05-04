@extends('layouts.main_layout')

@section('head')
    <title>{{$user->username}}&apos;s Profile</title>
@endsection

@section('mainBody')
    @include('inserts.breadcrumb')

    <div class="container-fluid">
		<ul class="nav nav-tabs r-tab-bottom">
  			<li class="active"><a href="profile/{{$user->username}}">Profile</a></li>
  			<li><a href="/profile/projects/{{$user->username}}">Projects</a></li>
  			@if ($user->username == Auth::user()->username)
				<li><a href="profile/edit/{{$user->username}}">Edit</a></li>
			@endif
		</ul>
		<div class="panel panel-default" >
			<div class="panel-body">
				<div class="row">
					<div class="col-md-2">
						<div class="center-block project-image" style="background-image: url({{$user->profile->getProfileImagePath()}});"></div>
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
			</div>
		</div>
	</div>
@stop
