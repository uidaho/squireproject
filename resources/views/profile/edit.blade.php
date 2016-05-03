@extends('layouts.main_layout')

@section('head')
    <title>Edit Profile</title>
@endsection

@section('mainBody')
    @include('inserts.breadcrumb')
    <form class="form-horizontal" action="{{url('profile/update')}}" method="POST">
		 {!! csrf_field() !!}
        <fieldset>
            <legend>Edit Profile</legend>
            <div class="form-group">
                <label for="first_name" class="col-lg-2 control-label">First Name</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="first_name" placeholder="First Name" value="{{$user->profile->first_name}}">
                </div>
            </div>
            <div class="form-group">
                <label for="last_name" class="col-lg-2 control-label">Last Name</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="last_name" placeholder="Last Name" value="{{$user->profile->last_name}}">
                </div>
            </div>
            <div class="form-group">
                <label for="date_of_birth" class="col-lg-2 control-label">Birth Date</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="date_of_birth" placeholder="Birth Date" value="{{$user->profile->date_of_birth}}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="phone" class="col-lg-2 control-label">Phone</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="phone" placeholder="Phone" value="{{$user->profile->phone}}">
                </div>
            </div>
            <div class="form-group">
                <label for="address" class="col-lg-2 control-label">Address</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="address" placeholder="Address" value="{{$user->profile->address}}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-2 control-label">Gender</div>
                <div class="col-lg-10">
                    <div class="radio">
                        <div class="col-lg-10">
							<label for="male" class="control-label">Male</label>
                            <input type="radio" name="gender" id="male" value="0" checked="">
                        </div>
                    </div>
                    <div class="radio">
                        <div class="col-lg-10">
							<label for="female" class="control-label">Female</label>
                            <input type="radio" name="gender" value="1">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="biography" class="col-lg-2 control-label">About Me</label>
                <div class="col-lg-10">
                    <textarea class="form-control" rows="3" id="biography" value="{{$user->profile->biography}}"></textarea>
					<grammarly-btn>
						<div style="z-index: 2; opacity: 1; transform: translate(409px, 50px);" class="_9b5ef6-textarea_btn _9b5ef6-not_focused" data-grammarly-reactid=".0">
							<div class="_9b5ef6-transform_wrap" data-grammarly-reactid=".0.0">
								<div title="Protected by Grammarly" class="_9b5ef6-status" data-grammarly-reactid=".0.0.0">
									&nbsp;
								</div>
							</div>
						</div>
					</grammarly-btn>
                    <span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>
                </div>
            </div>
            <button type="submit" id="submit" class="btn btn-default">Submit</button>
        </fieldset>
    </form>
@stop
