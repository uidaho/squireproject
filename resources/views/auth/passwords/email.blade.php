@extends('layouts.main_layout')

<!-- Main Content -->
@section('mainBody')

        <!-- Main -->

<main class="primary-main row">
    <section class="grid login-main">

        <!-- Login -->

        <div class="col-1-3">

            <form class="login-form" action="{{ url('/password/email') }}" method="POST">
                {!! csrf_field() !!}

                <h5>Reset Password</h5>

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <fieldset class="login">
                    <label>
                        Email Address
                        <input type="email" name="email" value="{{ old('email') }}">

                        @if ($errors->has('email'))
                            <span class="error-auth">{{ $errors->first('email') }}</span>
                        @endif

                    </label>
                </fieldset>
                <fieldset class="group">
                    <input class="btn" type="submit" value="Send Password Reset Link">
                </fieldset>
            </form>

        </div>

    </section>
</main>

@endsection
