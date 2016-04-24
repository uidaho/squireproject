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
                        <li>Binary Chat enabled? {{ Settings::user()->enable_chat }}</li>

                    </ul>
                </div>

                <table class="table table-striped table-hover ">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Settings</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>Setting 1</td>

                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Setting 2</td>

                    </tr>
                    <tr class="info">
                        <td>3</td>
                        <td>Setting 3</td>

                    </tr>
                    <tr class="success">
                        <td>4</td>
                        <td>Setting 4</td>

                    </tr>
                    <tr class="danger">
                        <td>5</td>
                        <td>Setting 5</td>

                    </tr>
                    <tr class="warning">
                        <td>6</td>
                        <td>Setting 6</td>

                    </tr>
                    <tr class="active">
                        <td>7</td>
                        <td>Setting 7</td>

                    </tr>
                    </tbody>
                </table>

            </section>

        </section>
    </main>

@stop