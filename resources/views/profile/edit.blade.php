@extends('layouts.main_layout')

@section('head')
    <title>Edit Profile</title>
@endsection

@section('mainBody')
    @include('inserts.breadcrumb')

    <div class="container-fluid">
        <ul class="nav nav-tabs r-tab-bottom">
            <li><a href="profile/{{$user->username}}">Profile</a></li>
            <li><a href="/profile/projects/{{$user->username}}">Projects</a></li>
            <li><a href="/profile/comments/{{$user->username}}">Comments</a></li>
            <li class="active"><a href="profile/edit/{{$user->username}}">Edit</a></li>
        </ul>
        <div class="panel panel-default">
            <div class="panel-body">
                <form class="form-horizontal" action="{{url('profile/update')}}" method="POST">
                    {!! csrf_field() !!}
                    <fieldset>
                        <div class="form-group row">
                            <label for="first_name" class="col-md-1 control-label">First Name</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                       value="{{$user->profile->first_name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="col-md-1 control-label">Last Name</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                       value="{{$user->profile->last_name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date_of_birth" class="col-md-1 control-label">Birth Date</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="date_of_birth" name="date_of_birth"
                                       value="{{$user->profile->date_of_birth}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-md-1 control-label">Phone</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="phone" name="phone"
                                       value="{{$user->profile->phone}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-1 control-label">Address</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="address" name="address"
                                       value="{{$user->profile->address}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-1 control-label">Gender</label>
                            <div class="col-md-4">
                                @if ($user->profile->gender)
                                    <div class="row">
                                        <div class="col-md-1"><label class="control-label" for="male">Male</label></div>
                                        <div class="col-md-1"><input class="radio" type="radio" name="gender" id="male"
                                                                     value="1" checked=""></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1"><label class="control-label" for="female">Female</label>
                                        </div>
                                        <div class="col-md-1"><input class="radio" type="radio" name="gender"
                                                                     id="female" value="0"></div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-md-1"><label class="control-label" for="male">Male</label></div>
                                        <div class="col-md-1"><input class="radio" type="radio" name="gender" id="male"
                                                                     value="1"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1"><label class="control-label" for="female">Female</label>
                                        </div>
                                        <div class="col-md-1"><input class="radio" type="radio" name="gender"
                                                                     id="female" value="0" checked=""></div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="biography" class="col-md-1 control-label">About Me</label>
                            <div class="col-md-4">
                                <textarea class="form-control" rows="3" id="biography" name="biography"
                                          placeholder="{{$user->profile->biography}}"></textarea>
                                <grammarly-btn>
                                    <div style="z-index: 2; opacity: 1; transform: translate(409px, 50px);"
                                         class="_9b5ef6-textarea_btn _9b5ef6-not_focused" data-grammarly-reactid=".0">
                                        <div class="_9b5ef6-transform_wrap" data-grammarly-reactid=".0.0">
                                            <div title="Protected by Grammarly" class="_9b5ef6-status"
                                                 data-grammarly-reactid=".0.0.0">
                                                &nbsp;
                                            </div>
                                        </div>
                                    </div>
                                </grammarly-btn>
                            </div>
                        </div>
                        <button type="submit" id="submit" class="btn btn-default">Submit</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop
