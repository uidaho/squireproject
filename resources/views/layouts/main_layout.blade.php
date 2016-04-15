<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">

        @yield('head')

        <!-- <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}"> -->
        <link href='https://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>
        <!-- bootstrap and theme-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

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