<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Redirect to main page if user is already logged in -->
        @unless(Auth::guest())
            <script>window.location.href = "projectfinder";</script>
        @endunless

        <meta charset="utf-8">
        <title>Home</title>
        <link rel="stylesheet" href="/css/main.css">
        <link href='https://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>

    </head>

    <body class="index-body">

        <!-- Header -->

        <header class="home-header container">

            <h1 class="large-logo">sQuire</h1>
            <h2 class="tagline"><strong>Start</strong> a project. <strong>Gather</strong> a team.
                <strong>Create</strong> the
                impossible. </h2>
            <a class="btn btn-reg" href="register">Register/Login</a>

        </header>

        <!-- Teasers -->

        <section class="row">
            <div class="grid">

                <!-- Start a project -->

                <section class="teaser col-1-3">

                    <h4>Start</h4>
                    <img src="/images/click.jpg" alt="Few Clicks">
                    <p>Just a couple clicks to put forth your ideas for your next project</p>

                </section><!--

		        Find a team

		        --><section class="teaser col-1-3">

                    <h4>Gather</h4>
                    <img src="/images/team.jpg" alt="Your Team">
                    <p>Assemble a team required to build your project</p>

                </section><!--

		        Create the impossible

		        --><section class="teaser col-1-3">

                    <h4>Create</h4>
                    <img src="images/create.jpg" alt="Start Creating">
                    <p>Begin creating with a built-in simultaneous multi-user Java editor and compiler</p>

                </section>

            </div>
        </section>

        <!-- Footer -->

        <footer class="primary-footer container group">

            <small>&copy; sQuire University of Idaho</small>

            <nav class="nav">
                <ul>
                    <li><a href="">Home</a></li><!--
			        --><li><a href="projectfinder">Explore</a></li><!--
			        --><li><a href="">Start a project</a></li><!--
			        --><li><a href="about">About us</a></li><!--
			        --><li><a href="">Contact us</a></li>
                </ul>
            </nav>

        </footer>

    </body>
</html>