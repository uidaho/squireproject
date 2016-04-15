<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">

        @yield('head')

        <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
        <link href='https://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>
        <!-- bootstrap and theme -->
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-theme.min.css') }}">
        <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    </head>

    <body>

        <!-- Header -->

        <header class="primary-header container group">

            <h3 class="logo">
                <a href="/projectfinder">sQuire</a>
            </h3>

            <!-- Login & Logout Area -->
            <ul class="nav">
                <div class="dropdown">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="/login">Login</a></li>
                        <li><a href="/register">Register</a></li>
                    @else
                        <a class="btn-username">{{ Auth::user()->username }}</a>
                        <div class="dropdown-content">
                            <a href="">Profile</a>
                            <a href="/logout">Logout</a>
                        </div>
                    @endif
                </div>
            </ul>

            <nav class="nav nav-primary">
                <ul>
                    <li><a href="">Home</a></li><!--
			        --><li><a href="/projectfinder">Explore</a></li><!--
			        --><li><a href="/create">Start a project</a></li><!--
			        --><li><a href="/about">About us</a></li>
                </ul>
            </nav>

        </header>

        @yield('mainBody')

        <!-- Footer -->

        <footer class="primary-footer container group">

            <small>&copy; sQuire University of Idaho</small>

            <nav class="nav">
                <ul>
                    <li><a href="">Home</a></li><!--
			        --><li><a href="/projectfinder">Explore</a></li><!--
			        --><li><a href="/create">Start a project</a></li><!--
			        --><li><a href="/about">About us</a></li><!--
			        --><li><a href="">Contact us</a></li>
                </ul>
            </nav>

        </footer>

    </body>
</html>