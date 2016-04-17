@extends('layouts.main_layout')

@section('head')
    <title>{{$files[0]->projectname}} Project Files | The Squire Project</title>
@endsection

@section('mainBody')
<div class="row">
    <div class="col-md-12">
        <!-- Search -->
        <form class="navbar-form navbar-right" role="search">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
        <!-- Toolbar -->
        <div class="btn-toolbar" role="toolbar" aria-label="File list toolbar">
            <div class="btn-group" role="group" aria-label="File command group">
                <a href="/editor/create/{{ $files[0]->projectname }}" class="btn btn-default btn-sm">
                    <em class="glyphicon glyphicon-plus"></em> Create
                </a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- Files -->
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                  <th>id</th>
                  <th>project_id</th>
                  <th>projectname</th>
                  <th>Filename</th>
                  <th>Type</th>
                  <th>Description</th>
                  <th>Creator</th>
                  <th>Created at</th>
                  <th>Updated at</th>
                  <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($files as $file)
                    <tr>
                        <td>{{ $file->id }}</td>
                        <td>{{ $file->project_id }}</td>
                        <td><a href="/editor/{{ $file->projectname }}">{{ $file->projectname }}</a></td>
                        <td><a href="/editor/edit/{{ $file->projectname }}/{{ $file->filename }}">{{ $file->filename }}</a></td>
                        <td>{{ $file->type }}</td>
                        <td>{{ $file->description }}</td>
                        <td><a href="/profile/view/{{ $file->user_id }}">{{ $file->author()->first()->username }}</td>
                        <td>{{ $file->created_at }}</td>
                        <td>{{ $file->updated_at }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="File action button group">
                                @if($file->user_id == $userid)
                                    <a href="/editor/delete/{{ $file->projectname }}/{{ $file->filename }}" class="btn btn-default btn-sm">
                                        <em class="glyphicon glyphicon-trash"></em> Delete
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop