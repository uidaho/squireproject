@extends('layouts.main_layout')

@section('head')

    <title>Settings</title>

@endsection

@section('mainBody')

    <main class="primary-main row">
        <section class="grid register-main">

            <form class="form-horizontal">
                <fieldset>
                    <legend>Legend</legend>
                    <div class="form-group">
                        <label for="inputNickname" class="col-lg-2 control-label">Nickname</label>
                        <div class="col-lg-10">
                            <input class="form-control" id="inputNickname" placeholder="inputNickname" type="text">
                                <div class="checkbox">
                            <label>
                                <input type="checkbox"> Enable Comments
                            </label>
                                </div>
                            </div>
                        </div>


                    <div class="form-group">
                        <label for="Bio" class="col-lg-2 control-label">Textarea</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" rows="3" id="textArea"></textarea>
                            <span class="help-block">Write a bio for yourself!</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Chat Options</label>
                        <div class="col-lg-10">
                            <div class="radio">
                                <label>
                                    <input name="optionsRadios" id="optionsRadios1" value="option1" checked="" type="radio">
                                    Enable Chat
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input name="optionsRadios" id="optionsRadios2" value="option2" type="radio">
                                    Disable Chat
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="select" class="col-lg-2 control-label">Additional Options</label>
                        <div class="col-lg-10">
                            <select class="form-control" id="select">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                            <br>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="reset" class="btn btn-default">Cancel</button>
                            <button type="submit" class="btn btn-primary">Apply</button>
                        </div>
                    </div>
                </fieldset>
            </form>

        </section>
    </main>

@stop