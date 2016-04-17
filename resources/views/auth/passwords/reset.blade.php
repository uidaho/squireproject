@extends('layouts.main_layout')

@section('head')
    <!-- Redirect to main page if user is already logged in -->
    @unless(Auth::guest())
        <script>window.location.href = "/projects";</script>
    @endunless

    <title>Password Reset</title>
@endsection

@section('mainBody')

    <!-- Main -->

    <main class="primary-main row">
        <section class="grid login-main">

            <!-- Login -->

            <div class="col-1-3">

                <form class="login-form" action="{{ url('/password/reset') }}" method="POST">
                    {!! csrf_field() !!}

                    <input type="hidden" name="token" value="{{ $token }}">

                    <h5>Reset Password</h5>

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <fieldset class="login">
                        <label>
                            Email Address
                            <input type="email" name="email" value="{{ $email or old('email') }}">

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
                    <fieldset class="group">
                        <input class="btn" type="submit" value="Reset Password">
                    </fieldset>
                </form>

            </div>

        </section>
    </main>

@stop