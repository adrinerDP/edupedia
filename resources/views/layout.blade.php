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
    <!-- Google Analytics & Adsense-->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-146850161-1"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-146850161-1');

        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-5481942781577149",
            enable_page_level_ads: true
        });
    </script>
</head>
<body>
@include('components.navigation')

@yield('content')

@include('components.footer')
@include('components.swiftalert')
</body>
</html>
