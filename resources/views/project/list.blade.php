@extends('layouts.main_layout')

@section('head')
    <title>Project Finder</title>
@endsection

@section('mainBody')
    @include('inserts.breadcrumb')
    <!-- Search -->
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            @if(session('delete-success'))
                <div class="alert alert-info alert-dismissible alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ session('delete-success') }}
                </div>
            @endif
        </div>
        <div class="col-md-12">
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
    <section class="row">
        <div class="r-project r-grid">
        @foreach($projects as $project)
            <section class="col-md-3">
                <div class="panel panel-default panel-project">
                    <a href="{{ $project->getSlug() }}" class="project-link">
                        <div class="panel-body r-small">
                            <div class="fallback-image">
                                <div class="project-image" style="background-image: url({{ $project->getImagePath() }});"></div>
                            </div>
                            <hr>
                            <span class="r-members">n+1 Members</span>
                            <h4>{{ $project->title }}</h4>
                            <div class="project-description">
                                {{ $project->description }}
                            </div>
                        </div>
                    </a>
                </div>
            </section>
        @endforeach
        </div>
    </section>
@stop