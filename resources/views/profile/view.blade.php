@extends('layouts.main_layout')

@section('head')
    <title>{{$username}}s Profile</title>
@endsection

@section('mainBody')
    @include('inserts.breadcrumb')
    <div class="container-fluid well">
        <legend>Profile</legend>
        <div class="row">
		    <div class="col-md-2">
		        <img class="center-block" scr="images/projects/DefaultProfile.jpg">
		    	<div class="">
					<h2 class="center"> {{$username}}</h2>
					<div class="btn-group btn-group-justified">
			        	<a href="#" class="btn btn-default">Send Message</a>
			        	<a href="#" class="btn btn-default">Add To Contact</a>
			    	</div>
				</div>
			</div>
			<div class="col-md-10">

		    	<div class="col-md-6">
		        	<h4>Basic Information</h4>
		            <label>User name:</label><p>{{$username}}</p><br/>
		            <label>Birth Date:</label><p>{{$username }}</p><br/>
		            <label>Gender:</label><p>{{$username}}</p><br/>
				</div>
				<div class="col-md-6">
		            <h4>Contact Information</h4>
		            <label>Email:</label><p>{{$username}}</p><br/>
		            <label>Phone:</label><p>{{$username}}</p><br/>
		            <label>Address:</label><p>{{$username}}</p><br/>
				</div>
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">About Me</div>
						<div class="panel-body">Panel content</div>
					</div>	
				<div/>
			<div/>
		<div/>
        <!-- Template: http://wrapbootstrap.com/preview/WB09JXK43 -->
    </div>
@stop
