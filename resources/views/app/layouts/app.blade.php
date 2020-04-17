<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: black !important;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }
    </style>

    <link rel="stylesheet" type="text/css" href="{{asset('bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/frontend.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front_side/css/burger.css')}}">
    @stack('styles')
</head>
<body>

@include('app.bars.menu_bar')

@include('app.components.carousel')

@yield('content')


{{--        <div class="container">--}}

{{--            <button class="btn btn-outline btn-yellow">--}}
{{--                Зжерти--}}
{{--            </button>--}}

{{--            <a href="#" class="btn btn-outline btn-yellow">--}}
{{--                Купити--}}
{{--            </a>--}}

{{--            <span class="btn btn-outline btn-yellow">--}}
{{--                Замовити--}}
{{--            </span>--}}

{{--        </div>--}}
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.js')}}"></script>
<script src="{{asset('front_side/js/front.js')}}"></script>
@stack('javascript')
</html>
