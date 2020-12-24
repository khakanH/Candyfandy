<!DOCTYPE html>
<html dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
       @include('partials/css')  

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kotler | Admin</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    




    <meta name="description" content="">
    <meta name="author" content="">
       <!-- All css files link -->
    </head>
    <body class="">  

        <div id="main-wrapper">
             <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>    
              @include('partials/topheader') 
              @include('partials/leftmenu') 

              
                    @yield('content')
                
        </div>
              

            @include('partials/footer') 





    </body>

    @include('partials/js')  
    @include('partials/modals')  
</html>