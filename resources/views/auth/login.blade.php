@extends('layouts.main_layout')

@section('head')
    <!-- Redirect to main page if user is already logged in -->
    @unless(Auth::guest())
        <script>window.location.href = "projectfinder";</script>
    @endunless

    <title>Login</title>

@endsection

@section('mainBody')

<!-- Main -->

<main class="primary-main row">
    <section class="grid login-main">

        <!-- Login -->

        <div class="col-1-3">

            <form name="myform" class="login-form" action="{{ url('/login') }}" method="POST" onsubmit="DoSubmit();">
                {!! csrf_field() !!}

                <h5>Login</h5>
                <fieldset class="login register">
                    <label>
                        Username or Email
                        <input type="text" name="username" value="{{ old('username') }}">

                        @if ($errors->has('username'))
                            <span class="error-auth">{{ $errors->first('username') }}</span>
                        @elseif($errors->has('email'))
                            <span class="error-auth">{{ $errors->first('email') }}</span>
                        @endif

                        <input type="hidden" name="email" value="{{ old('username') }}">

                    </label>
                    <label>
                        Password
                        <input type="password" name="password">

                        @if ($errors->has('password'))
                            <span class="error-auth">{{ $errors->first('password') }}</span>
                        @endif
                    </label>
                    <label>
                        <a class="btn" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
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

<script>
    function DoSubmit(){
        if (document.myform.username.value.indexOf("@") > -1) {
            document.myform.email.value = document.myform.username.value;
            document.myform.action = "/loginemail";
        }

        return true;
    }
</script>

@stop