<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('components.analytics.gtag')
    <title>{{ config('app.name') }}</title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="@yield('metaTitle',config('app.name'))" />
    <meta property="og:description" content="@yield('metaDescription','...')" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}" />
    <meta property="og:image" content="@yield('metaImage',asset('/img/media-card.png'))" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@kilrizzy" />
    <meta name="twitter:title" content="@yield('metaTitle',config('app.name'))" />
    <meta name="twitter:description" content="@yield('metaDescription','...')" />
    <meta name="twitter:image" content="@yield('metaImage',asset('/img/media-card.png'))" />
    <meta name="theme-color" content="#3182ce">
</head>