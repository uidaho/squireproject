@extends('layouts.main_layout')

@section('head')
    <title>{{$files[0]->projectname}} Project Files | The Squire Project</title>
@endsection

@section('mainBody')
<div class="row">
    <div class="col-md-12">
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
        <!-- Files -->
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                  <th>#</th>
                  <th>Filename</th>
                  <th>Type</th>
                  <th>Description</th>
                  <th>Creator</th>
                  <th>Created at</th>
                  <th>Updated at</th>
                </tr>
            </thead>
            <tbody>
                {{{$i = 1}}}
                @foreach($files as $file)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td><a href="/editor/edit/{{$file->projectname}}/{{$file->filename}}">{{$file->filename}}</a></td>
                        <td>{{$file->type}}</td>
                        <td>{{$file->description}}</td>
                        <td><a href="/profile/view/{{$file->creator}}">{{$file->creator}}</td>
                        <td>{{$file->created_at}}</td>
                        <td>{{$file->updated_at}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop