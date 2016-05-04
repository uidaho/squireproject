@extends('layouts.main_layout')

@section('head')
    <title>{{$user->username}}&apos;s Projects</title>
@endsection

@section('mainBody')
	@include('inserts.breadcrumb')

   <div class="container-fluid">
		<ul class="nav nav-tabs r-tab-bottom">
  			<li><a href="profile/{{$user->username}}">Profile</a></li>
  			<li class="active"><a href="/profile/projects/{{$user->username}}">Projects</a></li>
			@if ($user->username == Auth::user()->username)
				<li><a href="profile/edit/{{$user->username}}">Edit</a></li>
			@endif
		</ul>
		<div class="panel panel-default">
			<div class="panel-body">

				Add Project List Here

			</div>
		</div>
	</div.
@stop
