@extends('layouts.main_layout')

@section('head')
    <!-- Redirect to main page if user is already logged in -->
    @unless(Auth::guest())
        <script>window.location.href = "/projects";</script>
    @endunless

    <title>Register</title>

@endsection

@section('mainBody')
    <main class="primary-main row center-block">

        <div class="col-lg-5">
            <div class="jumbotron">
                <h2>Why Register?</h2>
                <ul>
                    <li>Reach like minded users</li>
                    <li>Turn a one man team into a 32 man team</li>
                    <li>Simultaneous user IDE</li>
                    <li>Chat with fellow team members</li>
                    <li>Project files located all in one spot</li>
                    <li>Projects backed-up to prevent file lose</li>
                    <li>Complete all in one project and team manager</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-5">
            <form class="form-horizontal" action="{{ url('/register') }}" method="POST">
                {!! csrf_field() !!}

                <fieldset>
                    <legend>Register</legend>
                    <div class="form-group">
                        @if($errors->has('username'))
                            <div class="has-error">
                        @endif
                        <label for="username" class="col-lg-2 control-label">Username</label>
                        <div class="col-lg-10">
                            <input class="form-control" type="text" id="username" name="username" placeholder="Username" value="{{ old('username') }}">
                            @if($errors->has('username'))
                                <label class="control-label">{{ $errors->first('username') }}</label>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        @if($errors->has('email'))
                            <div class="has-error">
                        @endif
                        <label for="email" class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-10">
                            <input type="email" class="form-control" id="email" name="email" placeholder="name@domain.com" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <label class="control-label">{{ $errors->first('email') }}</label>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        @if($errors->has('password'))
                            <div class="has-error">
                        @endif
                        <label for="password" class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control" id="password" name="password">
                            @if ($errors->has('password'))
                                <label class="control-label">{{ $errors->first('password') }}</label>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="col-lg-2 control-label">Repeat</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="submit" id="submit" class="btn btn-primary">Register</button>
                            <a class="already-member small col-xs-offset-1" href="/login">Already registered? Click here!</a>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>

    </main>
@stop