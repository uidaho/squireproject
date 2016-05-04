<main class="primary-main row center-block">
    <div class="jumbotron col-sm-6 col-sm-offset-3">
        <form name="loginForm" class="form-horizontal" action="{{ url('/login') }}" method="POST" onsubmit="DoSubmit();"  >
            {!! csrf_field() !!}

            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <fieldset>
                <legend>Login</legend>
                    <div @if($errors->has('username') || $errors->has('email')) class="has-error" @endif >
                        <div class="form-group">
                            <label for="username" class="col-lg-2 control-label">Username</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="text" id="username" name="username" placeholder="Username" value="{{old('username')}}">
                                <input type="hidden" id="email" name="email" value="{{ old('username') }}">
                                @if($errors->has('username') || $errors->has('email'))
                                <label class="control-label">
                                    @if($errors->has('username'))
                                        {{ $errors->first('username') }}
                                    @else
                                        {{ $errors->first('email') }}
                                    @endif
                                </label>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div @if($errors->has('password')) class="has-error" @endif >
                            <label for="password" class="col-lg-2 control-label">Password</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="password" id="password" name="password">
                                @if($errors->has('password'))
                                <label class="control-label">{{ $errors->first('password') }}</label>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="submit" id="submit" class="btn btn-primary">Login</button>
                            <a class="small col-xs-offset-1" href="{{ url('/password/reset') }}">Forgot your password?</a>
                            <a class="small col-xs-offset-1" href="{{ url('/register') }}">Not Registered?</a>
                        </div>
                        <div class="checkbox col-lg-10 col-lg-offset-2">
                            <label><input type="checkbox" name="remember">Remember Me</label>
                        </div>
                    </div>
            </fieldset>
        </form>
    </div>
</main>

<script>
    function DoSubmit(){
        if (document.loginForm.username.value.indexOf("@") > -1) {
            document.loginForm.email.value = document.loginForm.username.value;
            document.loginForm.action = "/loginemail";
        }
        return true;
    }
</script>