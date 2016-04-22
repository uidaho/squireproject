@extends('layouts.main_layout')

@section('head')
    <title>Password Reset</title>
@endsection

@section('mainBody')

<main class="primary-main row center-block">
    <div class="jumbotron col-sm-6 col-sm-offset-3">
        <form class="form-horizontal" action="{{ url('/password/reset') }}" method="POST">
            {!! csrf_field() !!}

            <input type="hidden" name="token" value="{{ $token }}">
            <fieldset>
                <legend>Reset Password</legend>

                <div class="form-group">
                    <!--
                    @if($errors->has('email'))
                        <div class="has-error">
                    @endif -->
                    <label for="email" class="col-lg-2 control-label">Email</label>
                    <div class="col-lg-10">
                        <input class="form-control" type="email" name="email" id="email" value="{{ $email or old('email') }}">
                        <!--@if ($errors->has('email'))
                            <label class="control-label">{{ $errors->first('email') }}</label>
                            </div>
                        @endif -->
                    </div>
                </div>
                @if($errors->has('password') or $errors->has('password_confirmation'))
                    <div class="has-error">
                @endif
                <div class="form-group">
                    <div class="col-lg-offset-2">
                        <div class="col-sm-6">
                            <label for="password" class="control-label">Type new password.</label>
                            <input class="form-control" type="password" id="password" name="password">
                        </div>
                        <div class="col-sm-6">
                            <label for="password_confirmation" class="control-label">Retype password.</label>
                            <input class="form-control" type="password" id="password_confirmation" name="password_confirmation">
                        </div>
                        @if($errors->has('password') or $errors->has('password_confirmation'))
                            <div class="col-sm-10">
                                <label class="control-label">
                                    @if($errors->has('password'))
                                        {{ $errors->first('password') }}
                                    @elseif($errors->has('password_confirmation'))
                                        {{ $errors->first('password_confirmation') }}
                                    @endif
                                </label>
                            </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="submit" class="btn btn-primary" id="submit">Change Password</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</main>
@stop