{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection--}}













<!DOCTYPE html>
<html lang="en">
	<head>
    <style>
    body{

}
p{
	color:#fff;
}

.login-form {
   background: url("../images/bgt.png") repeat scroll 0 0 rgba(0, 0, 0, 0);
   width:380px;
   margin: 15% auto;
   padding: 20px;
}
.title{font-family: Pacifico;text-decoration: underline;}


.form-footer {
	padding: 15px 40px;
}
.bt-login{
	background-color: #ff8627;
    color: #ffffff;
    padding-bottom: 10px;
    padding-top: 10px;
    transition: background-color 300ms linear 0s;
}
.form-signin .form-control{
  position: relative;
  height: auto;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus{
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 30px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
i{margin-right: 4%;color:#555555}
a{text-decoration: none;color:#555555;}

@media  (max-width: 660px) {
     .mobile{
     margin-bottom:336px;
     }


}

@media (min-width: 320px) and (max-width: 350px) {
     .login-form{
     	width: 280px !important;
     }
}

@media (min-width: 350px) and (max-width: 500px) {
     .login-form{
     	width: 300px !important;
     }

}

@media (min-width: 320px) and (max-width: 1023px) {
     body{
		background: url(../images/small-bg2.jpg) no-repeat center center fixed;
	  	-webkit-background-size: cover;
	  	-moz-background-size: cover;
	  	-o-background-size: cover;
	  	background-size: cover;
		background-color: #fff;
	}
}

@media (min-width: 1024px) and (max-width: 1360px) {
     body{
		background: url(../images/medium-bg2.jpg) no-repeat center center fixed;
	  	-webkit-background-size: cover;
	  	-moz-background-size: cover;
	  	-o-background-size: cover;
	  	background-size: cover;
		background-color: #fff;
	}
}

@media (min-width: 1361px) and (max-width: 1960px) {
     body{
		background: url(../images/bg2000.jpg) no-repeat center center fixed;
	  	-webkit-background-size: cover;
	  	-moz-background-size: cover;
	  	-o-background-size: cover;
	  	background-size: cover;
		background-color: #fff;
	}
}
</style>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Responsive Login Page</title>

		<!-- Bootstrap -->
		<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
		<link href="css/bootstrap.min.css" rel="stylesheet">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	</head>
<body style="    background: url(/splash.jpg) no-repeat;background-size: cover;
">
<div class="container mobile">
	<div class="login-form" style="background: #ffffffa6;">
		<h1 class="title text-center">Welcome</h1>
		<form id="login-form" method="POST" action="{{ route('login') }}" class="form-signin" role="form">
            @csrf
			<input name="email" id="email" type="email" class="form-control"placeholder="Email address" autofocus>
            <br>
			<input name="password" id="password" type="password" class="form-control disable" placeholder="Password">
			<button class="btn btn-block bt-login" type="submit">Sign In</button>
		</form>
		<div class="form-footer">
			<div class="row">
				<div class="col-xs-7 col-sm-7 col-md-7">
					<i class="fa fa-lock"></i>
					<a href="{{url('password/reset')}}"> Forgot password? </a>
				</div>
				<div class="col-xs-5 col-sm-5 col-md-5">
					<i class="fa fa-check"></i> <a href="#"> Sign Up </a>
				</div>
			</div>
		</div>
	</div>
    <br>
</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
</body>
</html>
