<h6>Comments</h6>

<ul class="list-group">
    @foreach($project->comments as $comment)
        <li class="list-group-item">

            <p>{{ $comment->comment_body }}</p>
            <p class="small"><br>
                Created by: <a href="#">{{ $comment->user->username }}</a>
                @if ($comment->created_at == $comment->updated_at)
                    Created: {{ $comment->getCreatedAt() }}
                @else
                    Updated: {{ $comment->getUpdatedAt() }}
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