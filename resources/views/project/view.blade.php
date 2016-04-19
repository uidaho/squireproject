@extends('layouts.main_layout')

@section('head')
    <title>{{ $project->title }}</title>
@stop

@section('mainBody')
    <div class="row">
        <div class="panel-body">
            <div class="fallback-image">
                <div class="project-image" style="background-image: url({{ $project->getImagePath() }});"></div>
            </div>
            <hr/>
            <span class="label label-default project-members">n+1 Members</span>
            <h4>{{ $project->title }}</h4>
            <div class="project-description">
                {{ $project->description }}
            </div>
            <div>
                {{ $project->body }}
            </div>
            <br>
            @if (Auth::check())
                <a href="/editor/{{ $project->getSlugFriendlyTitle() }}">
                    <button class="btn btn-default" id="view-files">View Files</button>
                </a>
                @if (Auth::user()->username == $project->author)
                    <a href="/project/delete/{{ $project->getSlugFriendlyTitle() }}">
                        <button class="btn btn-danger" id="delete">Delete</button>
                    </a>
                @endif
            @endif
        </div>

        <div class="col-md-6 col-md-offset-3">
            <br><!-- Remove <br> when actual stylesheet is implemented -->
            <h6>Comments</h6>

            <ul class="list-group">
                @foreach($project->comments as $comment)
                    <li class="list-group-item">

                        <p>{{ $comment->comment_body }}</p>
                        <p class="small"><br>
                            Created by: <a href="#">{{ $comment->user->username }}</a>
                            @if ($comment->created_at == $comment->updated_at)
                                Created at: {{ $comment->created_at }}
                            @else
                                Updated at: {{ $comment->updated_at }}
                            @endif
                        </p>

                        @if($comment->user_id == Auth::id())
                            <form action="/project/comments/{{ $comment->id }}" method="GET">
                                {!! csrf_field() !!}

                                <button type="submit" class="btn btn-xs btn-warning" value="Edit">
                                    Edit
                                </button>
                            </form>

                            <form action="/project/{{ $project->title }}/comments/{{ $comment->id }}" method="POST">
                                {!! csrf_field() !!}
                                {!! method_field('DELETE') !!}

                                <button type="submit" class="btn btn-xs btn-danger" value="Delete">
                                    Delete
                                </button>
                            </form>
                        @endif
                    </li>
                @endforeach
            </ul>

            <form class="form-group" method="POST" action="/project/{{ $project->title }}/comments">
                {!! csrf_field() !!}

                <h6>Add a Comment</h6>

                @if ($errors->has('comment_body'))
                    <span class="error-auth">{{ $errors->first('comment_body') }}</span>
                @elseif(Session::has('guestComment'))
                    <span class="error-auth">{{ Session::get('guestComment') }}</span>
                @elseif(Session::has('userComment'))
                    <span class="">{{ Session::get('userComment') }}</span>
                @endif

                <textarea class="form-control" name="comment_body">{{ old('comment_body') }}</textarea>
                <br><!-- Remove <br> when actual stylesheet is implemented -->
                <input class="btn btn-primary" type="submit" name="submit" value="Send">
            </form>

        </div>
        
    </div>
@stop