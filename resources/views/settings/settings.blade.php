@extends('layouts.main_layout')

@section('head')

    <title>Settings</title>

@endsection

@section('mainBody')

    <main class="primary-main row">
        <section class="grid register-main">

            <section class="col-2-3">

                <div class="mini-background">
                <h5>{{ Auth::user()->username }}'s settings</h5>
                    <ul class="join-points">
                        <li>Wow look at all these settings</li>
                        <li>Below should be the chat color</li>
                        <li>{{ Cache::get('user_settings:'.$chat_color) }}</li>

                    </ul>
                </div>

            </section>

        </section>
    </main>

@stop