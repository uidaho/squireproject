@extends('layouts.main_layout')

@section('head')

    <title>Create Project</title>

@endsection

@section('mainBody')

<main class="container primary-main">
    <form class="project-form" action="{{ url('/create') }}" method="post">
        {!! csrf_field() !!}
        <h5>Create Project</h5>
        <fieldset class="create-project">
            <label>
                Title
                <input type="text" name="title">
            </label>
            <label>
                Description
                <input type="text" name="description">
            </label>
            <input type="submit" value="Submit">
        </fieldset>
    </form>
</main>

@stop