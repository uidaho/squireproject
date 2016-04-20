@extends('layouts.main_layout')

@section('head')
    <title>Edit Comment</title>
@stop

@section('mainBody')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h4>Edit Comment</h4>

            <form class="form-group" method="POST" action="project/comments/update/{{ $comment->id }}">
                {!! csrf_field() !!}
                {!! method_field('PATCH') !!}

                @if ($errors->has('comment_body'))
                    <div class="alert alert-dismissible alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <p>{{ $errors->first('comment_body') }}</p>
                    </div>
                @endif

                <textarea class="form-control" name="comment_body">{{ $comment->comment_body }}{{ old('comment_body') }}</textarea>
                <br><!-- Remove <br> when actual stylesheet is implemented -->
                <input class="btn btn-primary" type="submit" name="submit" value="Send">
            </form>

        </div>

    </div>

@stop