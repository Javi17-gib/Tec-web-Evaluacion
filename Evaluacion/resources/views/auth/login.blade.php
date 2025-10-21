<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <title>Login - JV-COMPANY</title>
  <!-- loader-->
    <!--<link href="{{ asset('admin/assets/css/pace.min.css') }}" rel="stylesheet"/>
  <script src="{{ asset('admin/assets/js/pace.min.js') }}"></script> -->
  <!--favicon-->
  <link rel="icon" href="{{ asset('admin/assets/images/JAVIUser.png') }}" type="image/x-icon">
  <!-- Bootstrap core CSS-->
  <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="{{ asset('admin/assets/css/animate.css') }}" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="{{ asset('admin/assets/css/icons.css') }}" rel="stylesheet" type="text/css"/>
  <!-- Custom Style-->
  <link href="{{ asset('admin/assets/css/app-style.css') }}" rel="stylesheet"/>
</head>

<body class="bg-theme bg-theme1">

<div class="card card-authentication1 mx-auto my-5">
    <div class="card-body">
        <div class="card-content p-2">
            <div class="text-center">
                <img src="{{ asset('admin/assets/images/JAVI.png') }}" alt="logo icon" width="80">
            </div>
            <div class="card-title text-uppercase text-center py-3">Login</div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email" class="sr-only">Email</label>
                    <div class="position-relative has-icon-right">
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                               class="form-control input-shadow @error('email') is-invalid @enderror" placeholder="Enter Email">
                        <div class="form-control-position"><i class="icon-user"></i></div>
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="sr-only">Password</label>
                    <div class="position-relative has-icon-right">
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                               class="form-control input-shadow @error('password') is-invalid @enderror" placeholder="Enter Password">
                        <div class="form-control-position"><i class="icon-lock"></i></div>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group col-6">
                        <div class="icheck-material-white">
                            <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} />
                            <label for="remember">Remember me</label>
                        </div>
                    </div>
                    <div class="form-group col-6 text-right">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Forgot Password?</a>
                        @endif
                    </div>
                </div>

                <button type="submit" class="btn btn-light btn-block">Login</button>

                <div class="text-center mt-3">Or Sign In With</div>
                <div class="form-row mt-4">
                    <div class="form-group mb-0 col-6">
                        <button type="button" class="btn btn-light btn-block"><i class="fa fa-facebook-square"></i> Facebook</button>
                    </div>
                    <div class="form-group mb-0 col-6 text-right">
                        <button type="button" class="btn btn-light btn-block"><i class="fa fa-twitter-square"></i> Twitter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card-footer text-center py-3">
        <p class="text-warning mb-0">Don't have an account? <a href="{{ route('register') }}"> Sign Up here</a></p>
    </div>
</div>

<!--start color switcher--> 
<div class="right-sidebar"> 
<div class="switcher-icon"> 
<i class="zmdi zmdi-settings zmdi-hc-spin"></i>
</div> <div class="right-sidebar-content">
<p class="mb-0">Gaussion Texture</p> 
<hr> 
<ul class="switcher"> 
<li id="theme1"></li> 
<li id="theme2"></li> 
<li id="theme3"></li> 
<li id="theme4"></li> 
<li id="theme5"></li> 
<li id="theme6"></li> 
</ul> 
<p class="mb-0">Gradient Background</p> 
<hr> 
<ul class="switcher"> 
<li id="theme7"></li> 
<li id="theme8"></li> 
<li id="theme9"></li> 
<li id="theme10"></li> 
<li id="theme11"></li> 
<li id="theme12"></li> 
<li id="theme13"></li> 
<li id="theme14"></li> 
<li id="theme15"></li> 
</ul> 
</div> 
</div> 
<!--end color switcher-->

<!-- Scripts -->
<script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/sidebar-menu.js') }}"></script>
<script src="{{ asset('admin/assets/js/app-script.js') }}"></script>

</body>
</html>
