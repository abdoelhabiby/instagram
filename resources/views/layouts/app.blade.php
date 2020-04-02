<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

   <link rel="icon" href="{{asset('images/Instagram.svg')}}"> 

  <link href="{{asset('/')}}vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
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
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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

        <main class="py-4">
            @yield('content')
        </main>
    </div>

<script type="text/javascript" src="{{asset('/')}}vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('js/custom.js') }}"></script>


@stack('scripts')

<script type="text/javascript">
  $(function(){

    $(document).on('click','.foll_unfol',function(){
      var profileId = $(this).data('profile_id');
      var status = $(this).attr('data-id');
 
        
        if (status == 'yes') {


                $.ajax({   //send request to unfollow

                   url:"{{route('unfollow')}}",
                   method:'post',
                   datatype:'json',
                   data:{_token:"{{csrf_token()}}",profile_id:profileId},
                   beforeSend:function(){
                     $(".fa-sync").removeClass('d-none');
                   },
                   success:function(data){
                     
                     $('.foll_unfol').text('Follow');
                     $(".fa-sync").addClass('d-none');
                     $('.foll_unfol').attr('data-id','no');

                     if($.isNumeric($('.change_count').text())){
                         var getcount = parseInt($('.change_count').text()) -1 ;
                         $('.change_count').text(getcount);

                     }

                   },
                   error:function(data){

                     if(data.status == 401){

                        window.location.href = "{{route('login')}}";
                     }


                   }
                

               });

        }

       if (status == 'no'){  //send request to follow

         $.ajax({  

           url:"{{route('follow')}}",
           method:'post',
           datatype:'json',
           data:{_token:"{{csrf_token()}}",profile_id:profileId},
           beforeSend:function(){
             $(".fa-sync").removeClass('d-none');
           },
           success:function(data){

            $('.foll_unfol').text('Following');
            $('.foll_unfol').attr('data-id','yes');
             $(".fa-sync").addClass('d-none');

            if($.isNumeric($('.change_count').text())){
                var getcount = parseInt($('.change_count').text() ) + 1 ;
                $('.change_count').text(getcount);

               }

           },
           error:function(data){

             if(data.status == 401){

                window.location.href = "{{route('login')}}";
             }

           }
        
       });

        } // end else
    

    });

  }); // end  open jquery
</script>




</body>
</html>
