@extends('layouts.layout')

@section('head')
    <!-- Redirect to main page if user is already logged in -->
    @unless(Auth::guest())
        <script>window.location.href = "projectfinder";</script>
    @endunless
@endsection

@section('mainBody')
    <main class="primary-main row">
        <section class="grid register-main">

            <section class="col-2-3">

                <div class="register-why">
                    <h5 class="register-title">Why Register?</h5>

                    <ul class="join-points">
                        <li>Reach like minded users</li>
                        <li>Turn a one man team into a 32 man team</li>
                        <li>Simultaneous user IDE</li>
                        <li>Chat with fellow team members</li>
                        <li>Project files located all in one spot</li>
                        <li>Projects backed-up to prevent file lose</li>
                        <li>Complete all in one project and team manager</li>
                    </ul>
                </div>

            </section><!--

			Register

			--><section class="col-1-3">

                <form class="register-form" action="{{ url('/register') }}" method="POST">
                    {!! csrf_field() !!}

                    <h5>Register</h5>
                    <fieldset class="register">
                        <!--<label>
                            First and Last Name
                            <input type="text" name="name" placeholder="John Smith">
                        </label>-->
                        <label class="{{ $errors->has('username') ? ' has-error' : '' }}">
                            Username
                            <input type="text" name="username" value="{{ old('username') }}">

                            @if ($errors->has('username'))
                                <script>alert("error");</script>
                                <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                            @endif

                        </label>
                        <label class="{{ $errors->has('email') ? ' has-error' : '' }}">
                            Email
                            <input type="email" name="email" placeholder="name@domain.com" value="{{ old('email') }}">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif

                        </label>
                        <label class="{{ $errors->has('password') ? ' has-error' : '' }}">
                            Password
                            <input type="password" name="password">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif

                        </label>
                        <label class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            Repeat Password
                            <input type="password" name="password_confirmation">

                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                            @endif

                        </label>
                    </fieldset>
                    <fieldset>
                        <input class="btn" type="submit">
                        <a class="already-member" href="/login">Already registered click here</a>
                    </fieldset>
                </form>

            </section>

        </section>
    </main>
@stop