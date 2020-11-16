<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Owlix</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link href="{{ asset('img/logo-only.svg') }}" rel="icon" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
<div class="row main">
    <div class="col-md-7 text-center">
        <img src="{{ asset('img/home-banner.svg') }}" alt="" width="60%">
    </div>
    <div class="col-md-4 login-box align-self-center">
        <div class="container">
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
