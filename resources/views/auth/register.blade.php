@extends('layouts.main_layout')

@section('head')
    <!-- Redirect to main page if user is already logged in -->
    @unless(Auth::guest())
        <script>window.location.href = "/projects";</script>
    @endunless

    <title>Register</title>

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
                        <label>
                            Username
                            <input type="text" name="username" value="{{ old('username') }}">

                            @if ($errors->has('username'))
                                <span class="error-auth">{{ $errors->first('username') }}</span>
                            @endif

                        </label>
                        <label>
                            Email
                            <input type="email" name="email" placeholder="name@domain.com" value="{{ old('email') }}">

                            @if ($errors->has('email'))
                                <span class="error-auth">{{ $errors->first('email') }}</span>
                            @endif

                        </label>
                        <label>
                            Password
                            <input type="password" name="password">

                            @if ($errors->has('password'))
                                <span class="error-auth">{{ $errors->first('password') }}</span>
                            @endif

                        </label>
                        <label>
                            Repeat Password
                            <input type="password" name="password_confirmation">

                            @if ($errors->has('password_confirmation'))
                                <span class="error-auth">{{ $errors->first('password_confirmation') }}</span>
                            @endif

                        </label>
                    </fieldset>
                    <fieldset>
                        <input class="btn" id="submit" type="submit">
                        <a class="already-member" href="/login">Already registered click here</a>
                    </fieldset>
                </form>

            </section>

        </section>
    </main>
@stop