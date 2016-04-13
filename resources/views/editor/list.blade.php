@extends('layouts.main_layout')

@section('head')
    <title>{{$files[0]->projectname}} Files | The Squire Project</title>
@endsection

@section('mainBody')
<main class="primary-main row project-main">
    <section class="container">
        <!-- Search -->
        <ul class="project-search">
            <li><input class="search-textbox" type="text" name="searchName" placeholder="Search"></li><!--
			--><li><input class="btn btn-search" type="button" name="search" value="Search"></li>
        </ul>
        <!-- Sort -->
        <select class="project-sort" name="sortBy">
            <option value="filename" selected>Name</option>
            <option value="description">Description</option>
            <option value="created">Created</option>
            <option value="modified">Modified</option>
        </select>
    </section>

    <!-- Files -->
    <section class="grid">
        @foreach($files as $file)
            <div class="col-1-3 project-teaser">
                <a href="/editor/{{$file->projectname}}/{{$file->filename}}">
                    <h4>{{$file->filename}}</h4>
                    <p>Description: {{$file->type}}</p>
                    <p>Created by: {{$file->creator}}</p>
                    <p>Created: {{$file->created_at}}</p>
                    <p>Updated: {{$file->updated_at}}</p>
                </a>
            </div>
        @endforeach
    </section>
</main>
@stop