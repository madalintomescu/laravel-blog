<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('pageTitle') - {{ config('app.name') }}</title>

    <link rel="icon" href="https://cdn2.iconfinder.com/data/icons/bitsies/128/Pen-512.png">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    @include('layouts.styles')

</head>
<body>

    @include('layouts.navigation')

    <div class="container px-sm-0 px-lg-3">
        @yield('content')
    </div>

    @include('layouts.footer')

    @include('layouts.scripts')
    @include('layouts.alerts')
    @stack('scripts')

</body>
</html>
