@extends('layouts.main_layout')

@section('head')
    <!-- Redirect to main page if user is already logged in -->
    @unless(Auth::guest())
        <script>window.location.href = "/projects";</script>
    @endunless

    <title>Login</title>

@endsection

@section('mainBody')
    @include('auth.login_insert')
@stop