@extends('layouts.main_layout')

@section('head')

    <title>Settings</title>

@endsection

@section('mainBody')

    <main class="primary-main row">
        <section class="grid register-main">

            <form class="form-horizontal" action="{{ url("/settings")}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <fieldset>
                    <legend>Settings</legend>

                    <div class="form-group">
                        <label for="Nickname" class="col-lg-2 control-label">Nickname</label>
                        <div class="col-lg-10">
                            <input class="form-control" id="Nickname" placeholder="Nickname" type="text">
                                <div class="checkbox">
                            <label>
                                <input type="checkbox"> Enable Comments
                            </label>
                                </div>
                            </div>
                        </div>
                    <div class="form-group">


                        <label class="col-lg-2 control-label">Chat Options</label>
                        <div class="col-lg-10">
                            <div class="radio">
                                <label>
                                    <input name="optionsRadios" id="optionsRadios1" value=1 checked="" type="radio">
                                    Enable Chat
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input name="optionsRadios" id="optionsRadios2" value=0 type="radio">
                                    Disable Chat
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="select" class="col-lg-2 control-label">Color of editor font</label>
                        <div class="col-lg-10">
                            <select class="form-control" id="select">
                                <option>Red</option>
                                <option>Orange</option>
                                <option>Yellow</option>
                                <option>Green</option>
                                <option>Blue</option>
                                <option>Purple</option>
                            </select>
                            <br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="select" class="col-lg-2 control-label">Font of editor</label>
                        <div class="col-lg-10">
                            <select class="form-control" id="select">
                                <option>Times New Roman</option>
                                <option>Sans Serif</option>
                                <option>Comic Sans</option>
                                <option>Helvetica</option>
                                <option>Calibre</option>
                                <option>Ariel</option>
                            </select>
                            <br>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="reset" class="btn btn-default">Cancel</button>
                            <button  class="btn btn-primary">Apply</button>
                        </div>
                    </div>

                </fieldset>
            </form>

        </section>
    </main>

@stop