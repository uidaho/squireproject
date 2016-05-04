@extends('layouts.main_layout')

@section('head')
    <title>Temp Profile</title>
@stop

@section('mainBody')

    <section class="col-md-offset-4 col-md-8">
        @if (!Auth::guest())
            <!-- Change user to profile object -->
            <form action="profile1/delete/{{ Auth::user()->id }}" method="POST">
                {!! csrf_field() !!}
                {!! method_field('DELETE') !!}

                <p>{{ Auth::user()->username }} delete your account</p>
                <button name="delete-account" type="submit" class="btn btn-danger">
                    Delete Account
                </button>
            </form>
        @endif
    </section>

@stop