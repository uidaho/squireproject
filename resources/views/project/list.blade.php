@extends('layouts.main_layout')

@section('head')
    <title>Project Finder</title>
@endsection

@section('mainBody')
    @include('inserts.breadcrumb')
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
            <div class="panel panel-default panel-project">
                <a href="{{ $project->getSlug() }}" class="project-link">
                <div class="panel-body">
                    <div class="fallback-image">
                        <div class="project-image" style="background-image: url({{ $project->getImagePath() }});"></div>
                    </div>
                    <hr/>
                    <span class="label label-default project-memebers">n+1 Members</span>
                    <h4>{{ $project->title }}</h4>
                    <div class="project-description">
                        {{ $project->description }}
                    </div>
                </div>
                </a>
            </div>
            </a>
        </div>
        @endforeach
    </div>
@stop