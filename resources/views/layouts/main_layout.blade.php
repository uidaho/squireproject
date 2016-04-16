<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-theme.min.css') }}">
        <script src="{{ URL::asset('js/jquery-2.2.3.min.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
        @yield('head')
    </head>

    <body>
        <!-- FOOTER -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-default" role="navigation">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                            </button> <a class="navbar-brand" href="/">The Squire Project</a>
                        </div>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li class="active">
                                    <a href="/projectfinder">Explore Projects</a>
                                </li>
                                <li>
                                    <a href="/create">Start a Project</a>
                                </li>
                                <li>
                                    <a href="/about">About</a>
                                </li>
                                <li>
                                    <a href="#">Contact</a>
                                </li>
                            </ul>
                            <form class="navbar-form navbar-right" role="search">
                                <div class="form-group">
                                    <input type="text" class="form-control" />
                                </div>
                                <button type="submit" class="btn btn-default">
                                    Submit
                                </button>
                            </form>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">
                                    <!-- Authentication Links -->
                                    @if (Auth::guest())
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Not logged in<strong class="caret"></strong></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="/register">Register</a>
                                            </li>
                                            <li class="divider"> </li>
                                            <li>
                                                <a href="/login">Login</a>
                                            </li>
                                        </ul>
                                    @else
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->username }}<strong class="caret"></strong></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="#">Your Profile</a>
                                            </li>
                                            <li>
                                                <a href="#">Help</a>
                                            </li>
                                            <li class="divider"> </li>
                                            <li>
                                                <a href="#">Settings</a>
                                            </li>
                                            <li>
                                                <a href="/logout">Sign out</a>
                                            </li>
                                        </ul>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
            <!-- CONTENT -->
            @yield('mainBody')
        </div>
    </body>
</html>