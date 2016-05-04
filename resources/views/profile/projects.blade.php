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
            <li><a href="/profile/comments/{{$user->username}}">Comments</a></li>
            @if ($user->username == Auth::user()->username)
                <li><a href="profile/edit/{{$user->username}}">Edit</a></li>
            @endif
        </ul>
        <div class="panel panel-default">
            <div class="panel-body">
                @if (count($user->projects) > 0)
                <!-- Projects -->
                <section class="row">
                    <div class="r-project r-grid">
                        @foreach($user->projects as $project)
                            <section class="col-md-3">
                                <div class="panel panel-default panel-project">
                                    <a href="{{ $project->getSlug() }}" class="project-link">
                                        <div class="panel-body r-small">
                                            <div class="fallback-image">
                                                <div class="project-image" style="background-image: url({{ $project->getProjectImagePath() }});"></div>
                                            </div>
                                            <hr>
                                            <span class="r-members">Members: {{ $project->getMemberCount() }}</span>
                                            <h4>{{ $project->title }}</h4>
                                            <div class="project-description">
                                                {{ $project->description }}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </section>
                        @endforeach
                    </div>
                </section>
                @else
                    <h3>This user has no projects.</h3>
                @endif
            </div>
        </div>
    </div>
@stop
