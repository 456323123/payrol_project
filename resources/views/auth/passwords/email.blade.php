{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6 mb-3">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0 ">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

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
		<title>{{ __('Reset Password') }}</title>

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
		<h1 class="title text-center">{{ __('Reset Password') }}</h1>
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Please enter valid emial"  name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror    
        <br>
        
        <button type="submit" class="btn btn-block bt-login mt-3">
            {{ __('Send Password Reset Link') }}
        </button>   
		</form>
	
	</div>
    <br>
</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
</body>
</html>