<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="description" content="Meta description">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('pageTitle') - {{ config('app.name') }}</title>

  <link rel="icon" href="https://cdn2.iconfinder.com/data/icons/bitsies/128/Pen-512.png">

  @include('layouts.dashboard.styles')

</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">

  @include('layouts.dashboard.header')

  <div class="app-body">
    @include('layouts.dashboard.navigation')

    <main class="main">
      @yield('content')
    </main>
  </div>

  @include('layouts.dashboard.footer')

  @include('layouts.dashboard.scripts')
  @include('layouts.alerts')

  @stack('scripts')

</body>
</html>
