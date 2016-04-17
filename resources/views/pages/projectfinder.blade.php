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
            <!-- Search -->
            <form class="navbar-form navbar-right" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <!-- Sort -->
            <div class="btn-group">
                <a href="#" class="btn btn-default">Sorting</a>
                <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">File name</a></li>
                    <li><a href="#">Description</a></li>
                    <li><a href="#">Created by</a></li>
                    <li><a href="#">Created date</a></li>
                    <li><a href="#">Modified date</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Default</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Projects -->
    <div class="row">
        @foreach($projects as $project)
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <style type="text/css">
                        .project-image {
                            width: 100%;
                            height: 240px;
                            background-position: center;
                            background-repeat: no-repeat;
                            background-size: 100%;
                        }
                    </style>
                    <div class="project-image" style="background-image: url({{ $project->getImagePath() }});">
                        
                    </div>
                    <hr/>
                    <h4>{{ $project->title }}</h4>
                    <p>{{ $project->description }}</p>
                    <p class="team-count">Total members: 30</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@stop