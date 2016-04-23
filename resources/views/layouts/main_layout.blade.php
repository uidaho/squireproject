<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <base href="{{ url('/') }}/" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/application.css') }}">
        <link rel="stylesheet" href="/css/custom.css">
        <script src="{{ URL::asset('js/jquery-2.2.3.min.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
        <link rel="apple-touch-icon" sizes="57x57" href="/images/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/images/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/images/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/images/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/images/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/images/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/images/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/images/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/images/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/images/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
        <link rel="manifest" href="/images/favicon/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/images/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        @yield('head')
    </head>

    <body>
        <!-- BODY -->
        <section class="container-fluid">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        	<span class="sr-only">Toggle navigation</span>
                        	<span class="icon-bar"></span>
                        	<span class="icon-bar"></span>
                        	<span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">The Squire Project</a>
                    </div>
                
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <form class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li class="{{ Request::is('projects') ? 'active' : '' }}">
                                <a href="/projects">Explore Projects</a>
                            </li>
                            <li class="{{ Request::is('project/create') ? 'active' : '' }}">
                                <a href="/project/create">Start a Project</a>
                            </li>
                            <li class="{{ Request::is('about') ? 'active' : '' }}">
                                <a href="/about">About</a>
                            </li>
                            <li class="{{ Request::is('contact') ? 'active' : '' }}">
                                <a href="#">Contact</a>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right" id="bs-example-navbar-collapse-1">
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
                    </form><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    @if(session('alert'))
                        <div class="alert alert-info alert-dismissible alert-success">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {!! session('alert') !!}
                        </div>
                    @endif
                </div>
            </div>
            <!-- CONTENT -->
            @yield('mainBody')
        </>
    </body>
</html>