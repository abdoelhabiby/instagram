<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
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

    @yield('content')


     
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