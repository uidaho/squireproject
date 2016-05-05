@extends('layouts.main_layout')

@section('head')
    <title>Settings for {{ $settings->nickname }} | The Squire Project</title>
@endsection

@section('mainBody')
<main class="primary-main row">
    <section class="grid register-main">
        <form class="form-horizontal" action="{{ url("/settings/update") }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <fieldset>
                <legend>Settings</legend>
                <div class="form-group">
                    <label for="Nickname" class="col-lg-2 control-label">Nickname</label>
                    <div class="col-lg-10">
                        <input class="form-control" name="nickname" id="nickname" type="text" value="@if(old('nickname')){{ old('nickname') }}@else{{ $settings->nickname }}@endif">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Chat Options</label>
                    <div class="col-lg-10">
                        <div class="radio">
                            <label>
                                <input name="enable_chat" id="enable_chat" value=1 @if($settings->enable_chat == 1)checked=""@endif type="radio">
                                Enable Chat
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input name="enable_chat" id="enable_chat" value=0 @if($settings->enable_chat == 0)checked=""@endif type="radio">
                                Disable Chat
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="select" class="col-lg-2 control-label">Color of editor font</label>
                    <div class="col-lg-10">
                        <select class="form-control" id="editor_font_color" name="editor_font_color">
                            <option>Black</option>
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
                        <select class="form-control" id="editor_font" name="editor_font">
                            <option>Consolas</option>
                            <option>Times New Roman</option>
                            <option>Sans Serif</option>
                            <option>Comic Sans</option>
                            <option>Helvetica</option>
                            <option>Calibri</option>
                            <option>Arial</option>
                        </select>
                        <br>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <a href="{{ back()->getTargetUrl() }}">
                            <button type="button" class="btn btn-danger">Cancel</button>
                        </a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </section>
</main>
@stop