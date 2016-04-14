<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">

        @yield('head')

        <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
        <link href='https://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>
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