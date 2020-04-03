<!DOCTYPE html>
<html lang="en">
<head>
    <title>register</title>
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

            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Instagram
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else


                         <li class="nav-item ">
                           <a class="nav-link" href="{{ route('home') }}" style="font-weight:bold; ">
                              <i class="fa fa-home fa-lg"></i>
                           </a>   
                         </li>
                        <!-- ------------------------------------------ -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile',user()->username) }}"
                                       >
                                        {{ __('profile') }}
                                    </a>
                                    <hr>
                                     <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    <!-- --------------------------------------------------------------------- -->
    <div class="limiter">
        <div class="container-login100" style="background-image: url('{{asset('templateLogin')}}/images/bg-01.jpg');">
            <div class="wrap-login100">
                <form class="login100-form validate-form" method="post" action="{{ route('register') }}">
                    @csrf

                    <span class="login100-form-title p-b-34">
                        register
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

<!-- ----------------------------------------------------------------------------- -->
                    <div class="wrap-input100 validate-input" data-validate = "Enter name">

                      <input class="input100" type="text" name="name" value="{{old('name')}}" placeholder="Name">
 

                        <span class="focus-input100" data-placeholder="&#xf207;"></span>
                    </div>

<!-- ----------------------------------------------------------------------------- -->
                    <div class="wrap-input100 validate-input" data-validate = "Enter username">

                      <input class="input100" type="text" name="username" value="{{old('username')}}" placeholder="username">
 

                        <span class="focus-input100" data-placeholder="&#xf207;"></span>
                    </div>
<!-- ----------------------------------------------------------------------------- -->
                    <div class="wrap-input100 validate-input" data-validate = "Enter Email">

                      <input class="input100" type="email" name="email" value="{{old('email')}}" placeholder="E-mail">
                        <span class="focus-input100" data-placeholder="&#xf207;"></span>
                    </div>
<!-- ----------------------------------------------------------------------------- -->
                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <input class="input100" type="password" name="password" placeholder="Password">
                        <span class="focus-input100" data-placeholder="&#xf191;"></span>
     
                    </div>
    <!-- ----------------------------------------------------------------------------- -->
                    <div class="wrap-input100 validate-input" data-validate="Enter password_confirmation">
                        <input class="input100" type="password" name="password_confirmation" placeholder="Password Confirmation">
                        <span class="focus-input100" data-placeholder="&#xf191;"></span>
     
                    </div>
<!-- ----------------------------------------------------------------------------- -->


                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" type="submit">
                            Register
                        </button>

                    </div> 

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