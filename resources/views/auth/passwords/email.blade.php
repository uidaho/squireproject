@extends('layouts.main_layout')

@section('mainBody')

<main class="primary-main row center-block">
        @if(session('status'))
        <div class="col-sm-6 col-sm-offset-3">
            <div class="alert alert-dismissible alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                Email sent.
            </div>
        </div>
    @endif
    <div class="jumbotron col-sm-6 col-sm-offset-3">
        <form class="form-horizontal" action="{{ url('/password/email') }}" method="POST">
            {!! csrf_field() !!}

            <fieldset>
                <legend>Reset Password</legend>

                <div class="form-group">
                    @if($errors->has('email'))
                        <div class="has-error">
                    @endif
                    <label for="email" class="col-lg-2 control-label">Email</label>
                    <div class="col-lg-10">
                        <input class="form-control" type="text" id="email" name="email" placeholder="name@domain.com" value="{{ old('username') }}">
                        @if($errors->has('email'))
                            <label class="control-label">{{ $errors->first('email') }}</label>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="submit" id="submit" class="btn btn-primary">Send Password Reset Link</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</main>

@endsection
