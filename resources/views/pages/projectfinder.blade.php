@extends('layouts.layout')

@section('mainBody')

<!-- Search -->

<main class="primary-main row project-main">

    <section class="container">
        <ul class="project-search">
            <li><input class="search-textbox" type="text" name="searchName" placeholder="Project title..."></li><!--
			--><li><input class="btn btn-search" type="button" name="search" value="Search"></li>
        </ul>

        <select class="project-sort" name="sortBy">
            <option value="Title" selected>Title</option>
            <option value="TeamCount">Team Count</option>
            <option value="Author">Author</option>
        </select>

    </section>

    <!-- Projects -->

    <section class="grid">

        <div class="col-1-3 project-teaser">
            <a href="index.html">
                <img src="/images/projects/product1.jpg" alt="Project Image">
                <h4>Squire Ultra</h4>
                <p>Cross platform group IDE and super computer.</p>
                <p class="team-count">Total members: 30</p>
            </a>
        </div><!--

		--><div class="col-1-3 project-teaser">
            <a href="index.html">
                <img src="/images/projects/product2.jpg" alt="Project Image">
                <h4>Fancy Images</h4>
                <p>Takes your photos and auto touches them up and allows for user edits.</p>
                <p class="team-count">Total members: 15</p>
            </a>
        </div><!--

		--><div class="col-1-3 project-teaser">
            <a href="index.html">
                <img src="/images/projects/product3.jpg" alt="Project Image">
                <h4>News Catcher</h4>
                <p>Collects all the news you need to know about based upon location and interests.</p>
                <p class="team-count">Total members: 10</p>
            </a>
        </div>

        <!-- Next Row-->

        <div class="col-1-3 project-teaser">
            <a href="index.html">
                <img src="/images/projects/product4.jpg" alt="Project Image">
                <h4>Simple Graphs</h4>
                <p>Takes the users input and creates beautifully rendered graphs.</p>
                <p class="team-count">Total members: 3</p>
            </a>
        </div><!--

		--><div class="col-1-3 project-teaser">
            <a href="index.html">
                <img src="/images/projects/product5.jpg" alt="Project Image">
                <h4>Key Remapper</h4>
                <p>Allows the user to remap any keys on their keyboard with ease.<br></p>
                <p class="team-count">Total members: 2</p>
            </a>
        </div><!--

		--><div class="col-1-3 project-teaser">
            <a href="index.html">
                <img src="/images/projects/product6.jpg" alt="Project Image">
                <h4>Daily Activity Tracker</h4>
                <p>Smart phone app that allows the user to keep track of their activity and is diplayed in simple
                    graphs.</p>
                <p class="team-count">Total members: 5</p>
            </a>
        </div>

    </section>
</main>

@stop