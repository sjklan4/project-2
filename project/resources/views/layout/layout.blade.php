<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/common.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('css/header.css')}}">
    @section('css')
    @show
</head>
<body>
<<<<<<< HEAD
{{-- <body  data-url="{{ url('user/chdeckEmail') }}" data-csrf="{{ csrf_token() }}"> --}}
=======
    {{-- data-url="{{ url('user/chdeckEmail') }}" data-csrf="{{ csrf_token() }}"> --}}
>>>>>>> 6c45eab85eb5561f863b3f0d23e4fe47a79e3b1f
    @include('layout.header')
    @yield('contents')
    @include('layout.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{asset('js/common.js')}}"></script>
    @yield('js')
</body>
</html>