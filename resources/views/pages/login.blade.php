@extends('layouts.layout')

@section('head')
    <!-- Redirect to main page if user is already logged in -->
    @unless(Auth::guest())
        <script>window.location.href = "projectfinder";</script>
    @endunless
@endsection

@section('mainBody')

<!-- Main -->

<main class="primary-main row">
    <section class="grid login-main">

        <!-- Login -->

        <div class="col-1-3">

            <form class="login-form" action="{{ url('login') }}" method="POST">
                {!! csrf_field() !!}

                <h5>Login</h5>
                <fieldset class="login">
                    <label>
                        Username
                        <input type="text" name="username" value="{{ old('username') }}">

                        @if ($errors->has('username'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                        @endif

                    </label>
                    <label>
                        Password
                        <input type="password" name="password">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif

                    </label>
                </fieldset>
                <fieldset class="account-action group">
                    <input class="btn" type="submit">
                    <label>
                        <input type="checkbox" name="remember"> Remember Me
                    </label>

                </fieldset>
            </form>

        </div>

    </section>
</main>

@stop