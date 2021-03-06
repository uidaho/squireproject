<h4>Comments</h4>

<ul class="list-group r-bound">
    @foreach($project->comments as $comment)
        <li class="list-group-item">

            <!-- todo css font sizes -->
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

            @if($comment->user_id == Auth::id())
                <form class="span4" action="/project/comments/edit/{{ $comment->id }}" method="GET">
                    {!! csrf_field() !!}

                    <button name="comment-edit" type="submit" class="pull-left btn btn-xs btn-warning" value="Edit">
                        Edit
                    </button>
                </form>

                <form class="offset2" action="project/comments/{{ $comment->id }}" method="POST">
                    {!! csrf_field() !!}
                    {!! method_field('DELETE') !!}

                    <button name="comment-delete" type="submit" class="btn btn-xs btn-danger" value="Delete">
                        Delete
                    </button>
                </form>
            @endif
        </li>
    @endforeach
</ul>

<h4>Add a Comment</h4>

@if (Auth::guest())
    <form>
        <span class="label label-warning">Warning</span>
        <textarea name="comment-message" class="form-control">You must be logged in to leave a comment.</textarea>
        <br><!-- Remove <br> when actual stylesheet is implemented -->
        <!-- Trigger the modal with a button -->
        <button name="comment-login" class="btn btn-warning" data-toggle="modal" data-target="#loginForm">Login</button>
        <!-- Modal -->
        <div class="modal fade" id="loginForm" role="dialog">
            <div class="modal-dialog modal-lg">
                @include('auth.login_insert')
            </div>
        </div>
    </form>
@else
    <form class="form-group" method="POST" action="/project/{{ $project->title }}/addComment">
        {!! csrf_field() !!}

        @if ($errors->has('comment_body'))
            <div class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <p>{{ $errors->first('comment_body') }}</p>
            </div>
        @elseif(Session::has('comment_success'))
            <div class="alert alert-dismissible alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <p>{{ Session::get('comment_success') }}</p>
            </div>
        @endif

        <textarea class="form-control" name="comment_body">{{ old('comment_body') }}</textarea>
        <br><!-- Remove <br> when actual stylesheet is implemented -->
        <input class="btn btn-primary" type="submit" name="submit-comment" value="Send">
    </form>
@endif