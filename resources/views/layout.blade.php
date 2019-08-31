<!doctype html>
<html lang="ko">
<head>
    <!-- META -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@hasSection('title') @yield('title') · @endif {{ config('app.name') }}</title>
    <!-- CSS -->
    <link rel="stylesheet" href="/css/app.css">
    @yield('css')
    <!-- JS -->
    <script src="/js/app.js"></script>
    @yield('js')
    <!-- RESOURCES -->
    @yield('resource')
    @yield('resource_backup')
</head>
<body>
@include('components.navigation')

@yield('content')

@include('components.footer')
@include('components.swiftalert')
</body>
</html>
