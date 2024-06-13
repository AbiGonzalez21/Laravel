<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROYECTO FRONT-BACK LARAVEL - @yield('titulo')</title>

    <!-- Laravel Framework 10.47.0-->
    <!-- LaravelCollective 6.4-->
    <!-- cdn Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <!-- cdn Plantilla-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/superhero/bootstrap.min.css" >
    <link rel="stylesheet" href="css/style1.css">
    <!-- cdn iconos-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Link de ckeditor -->
    <script src="//cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    
</head>
<body>
    @include('secciones.menu')
    @if(\Session::has('mensaje'))
    @include('secciones.mensajes')
    @endif
    @yield('contenido')
    
    @include('secciones.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Agrega estos scripts al final del body -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    
    <!-- Archivo main.js -->
    <script src="{{ asset('js/main.js') }}"></script>

</body>
</html>
