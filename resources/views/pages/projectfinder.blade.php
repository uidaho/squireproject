@extends('layouts.main_layout')

@section('head')
    <title>Project Finder</title>
@endsection

@section('mainBody')
    <!-- Search -->
    <div class="row">
        <div class="col-md-12">
            <section class ="grid">
                @if(Session::has('delete-success'))
                    <div class="alert alert-info highlight col-sm-1" >{{ Session::get('delete-success') }}</div>
                @endif
            </section>
            <ul class="project-search">
                <li><input class="search-textbox" type="text" name="searchName" placeholder="Project title..."></li><!--
                    --><li><input class="btn btn-search" type="button" name="search" value="Search"></li>
            </ul>
            <select class="project-sort" name="sortBy">
                <option value="Title" selected>Title</option>
                <option value="TeamCount">Team Count</option>
                <option value="Author">Author</option>
            </select>
        </div>
    </div>

    <!-- Projects -->
    <div class="row">
        @foreach($projects as $project)
        <div class="col-md-4">
            <a href="project/{{ $project->id }}">
                <img src="/images/projects/product{{ $project->id }}.jpg" alt="Project Image">
                <h4>{{ $project->title }}</h4>
                <p>{{ $project->description }}</p>
                <p class="team-count">Total members: 30</p>
            </a>
        </div>
        @endforeach
    </div>
@stop