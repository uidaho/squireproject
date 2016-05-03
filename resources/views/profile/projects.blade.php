@extends('layouts.main_layout')

@section('head')
    <title>User Profile</title>
@endsection

@section('mainBody')
    @include('inserts.breadcrumb')
    {{Auth::user()->username }}
    {{Auth::user()->id}}
@stop
