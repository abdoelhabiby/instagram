<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
   <link rel="icon" href="{{asset('images/Instagram.svg')}}"> 

<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('templateLogin')}}/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('templateLogin')}}/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('templateLogin')}}/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('templateLogin')}}/vendor/animate/animate.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="{{asset('templateLogin')}}/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('templateLogin')}}/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('templateLogin')}}/vendor/select2/select2.min.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="{{asset('templateLogin')}}/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('templateLogin')}}/css/util.css">
    <link rel="stylesheet" type="text/css" href="{{asset('templateLogin')}}/css/main.css">
<!--===============================================================================================-->
</head>
<body>
    
    <div class="limiter">
        <div class="container-login100" style="background-image: url('{{asset('templateLogin')}}/images/bg-01.jpg');">
            <div class="wrap-login100">
                <form class="login100-form validate-form" method="post" action="{{ route('login') }}">
                    @csrf
                    <span class="login100-form-logo">
                       <i class="fa fa-instagram"></i>
                     </span>


                    <span class="login100-form-title p-b-34 p-t-27">
                        Log in
                    </span>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif


                    <div class="wrap-input100 validate-input" data-validate = "Enter Email">

                      <input class="input100" type="email" name="email" value="{{old('email')}}" placeholder="E-mail">
 

                        <span class="focus-input100" data-placeholder="&#xf207;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <input class="input100" type="password" name="password" placeholder="Password">
                        <span class="focus-input100" data-placeholder="&#xf191;"></span>
     
                    </div>

                    <div class="contact100-form-checkbox">
                        <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember">
                        <label class="label-checkbox100" for="ckb1"
                           "{{old('remember') ? 'checked' : ''}}">
                            Remember me
                        </label>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" type="submit">
                            Login
                        </button>

                    </div>

                   @if(Route::has('password.request')) 
                    <div class="text-center mt-3">
                       <a class="txt1 d-block" href="{{ route('password.request') }}">
                            Forgot Password?
                      </a>
                    @if(Route::has('register'))  
                      <a class="txt1 d-inline" href="{{ route('register') }}">
                            {{ __('Register') }}
                      </a>
                    @endif  
                    </div>
                   @endif 


                </form>
            </div>
        </div>
    </div>
    

    
<!--===============================================================================================-->
<script type="text/javascript" src="{{asset('/')}}vendor/jquery/jquery.min.js"></script>
<!--===============================================================================================-->
    <script src="{{asset('templateLogin')}}/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
    <script src="{{asset('templateLogin')}}/vendor/bootstrap/js/popper.js"></script>
    <script src="{{asset('templateLogin')}}/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--=============================================================================================== -->
    <script src="{{asset('templateLogin')}}/js/main.js"></script>

</body>
</html>