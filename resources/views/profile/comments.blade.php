@extends('layouts.main_layout')

@section('head')
    <title>{{$user->username}}s Comments</title>
@stop

@section('mainBody')
    @include('inserts.breadcrumb')

    <div class="container-fluid">
        <ul class="nav nav-tabs r-tab-bottom">
            <li><a href="profile/{{$user->username}}">Profile</a></li>
            <li><a href="/profile/projects/{{$user->username}}">Projects</a></li>
            <li class="active"><a href="/profile/comments/{{$user->username}}">Comments</a></li>
            @if ($user->username == Auth::user()->username)
                <li><a href="profile/edit/{{$user->username}}">Edit</a></li>
            @endif
        </ul>
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="list-group r-bound">
                    @if (count($user->comments) > 0)
                        @foreach($user->comments as $comment)
                            <li class="list-group-item">
                                <h5>{{ $comment->comment_body }}</h5>
                                <p>
                                    <br>
                                    Created by: <a href="#">{{ $comment->user->username }}</a>
                                    @if ($comment->created_at == $comment->updated_at)
                                        Created: {{ $comment->getCreatedAt() }}
                                    @else
                                        Updated: {{ $comment->getUpdatedAt() }}
                                    @endif
                                </p>
                            </li>
                        @endforeach
                    @else
                        <h3>This user has no comments.</h3>
                    @endif
                </ul>
            </div>
        </div>
    </div>
@stop
