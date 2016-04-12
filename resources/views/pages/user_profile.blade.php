@extends('layouts.main_layout')

@section('head')

    <title>user_profile</title>

@endsection

@section('mainBody')

    <main class="primary-main row">
        <section class="profile-main">

            <section class="col-1-2">
            <img scr="images/DefaultProfile.jpg"  style="height:175px;width:250px;">


        <div class="profile-username">
            <h1>User Name:</h1>
        </div>
            </section>


        <nav class="nav nav-profile">
            <ul>
                <li><a href="/user_profile">Profile</a></li>
                <li><a href="/user_projects">Projects</a></li>
                <li><a href="/about">Friends</a></li>
            </ul>
        </nav>

            <p style="margin: 30px;"> Full Name:  Team Lambda</p>
            <p style="margin: 30px;"> Email:      Lambda@vandals.uidaho.edu</p>
            <p style="margin: 30px;"> Groups:     </p>

        </section>
    </main>




@stop