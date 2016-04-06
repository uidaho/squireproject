@extends('layouts.main_layout')

@section('head')
    <!-- Redirect to main page if user is already logged in -->
    @unless(Auth::guest())
        <script>window.location.href = "projectfinder";</script>
    @endunless

    <title>Password Reset</title>
@endsection

@section('mainBody')


@stop