<!DOCTYPE html>
<html class="no-js" lang="{{ app()->getLocale() }}">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-123943601-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-123943601-1');
    </script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="OloyFit, conectando pessoas que buscam um estilo de vida saudável.">
    <meta name="keywords" content="OloyFit, oloyfit, vida saudavel, bem estar, suplementos" >
    <meta name="keywords" content="alimentacao saudavel, nutricionistas, nutrólogos, personal trainer" >
    <meta name="author" content="OloyFit">
    <meta name="robot" content="all" >
    <meta name="googlebot" content="all">
    <meta name="google-site-verification" content="iMnIjKg586mnbtTv_Tx4EFLcyFkmoSDPEZ4nHcV3GRM" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} {{ config('app.subtitle', 'Laravel') }}</title>

    <link rel="apple-touch-icon" href="apple-icon.png">
    <<link rel="shortcut icon" href="{{ asset('public/images/oloyfitico.ico') }}">

    <link rel="stylesheet" href="{{ asset('public/assets/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/scss/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/scss/socials.css') }}">
    <link href="{{ asset('public/assets/css/lib/vector-map/jqvmap.min.css') }}" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>
<body class="bg-dark">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        @yield('content')
    </div>


    <script src="{{ asset('public/assets/js/vendor/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('public/assets/js/main.js') }}"></script>


</body>
</html>
