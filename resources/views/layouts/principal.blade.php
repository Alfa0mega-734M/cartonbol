<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tienda - CARTONBOL</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    @yield('styles')

</head>
<body>
    
    <div id="app">
        @yield('contenido')
    </div>
    

    <script src="{{ asset('jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('popper/popper.min.js') }}"></script> 
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>


    <script>
        $(document).ready( function(){
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
        
    </script>
    @if (env('APP_ENV')=="local")
        <script src="{{ asset('js/vue.js') }}"></script>         
    @else
        <script src="{{ asset('js/vue.min.js') }}"></script> 
    @endif
    
    @yield('scripts')
</body>
</html>