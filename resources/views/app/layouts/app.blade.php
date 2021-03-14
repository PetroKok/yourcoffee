<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="robots" content="index, archive"/>

    <meta name="description"
          content="Your Burger народився в місті Стебник на початку 2018 року. У нас ви можете замовити унікальні бургери із яловичини та курятини, різноманітні снеки, салати й неперевершину картопельку фрі із різноманітними додатками. Ми використовуємо тільки натуральні, найвищої якості продукти під час приготування крафтових бургерів. На кухнях Your Burger ми використовуємо виключно сіль з Дрогобицької солеварні. А ще в Your Burger смачнезна, ароматна кава, яка надзвичайно смакує із цікавими десертами – донатсами та міні-пончиками."/>

    <title>{{config('app.name')}}</title>

    <!-- Styles -->
    <style>
        html, body {
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            margin: 0;
            background-color: #000000 !important;
        }
    </style>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('css/frontend.css?v3', config('app.https'))}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front_side/css/burger.css?v3', config('app.https'))}}">
    @stack('styles')
</head>
<body>
@include('app.bars.menu_bar')

@yield('content')

@include('app.layouts.footer')
</body>
{{--<script defer src="{{asset('js/app.js', config('app.https'))}}"></script>--}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script defer src="{{asset('bootstrap/js/bootstrap.bundle.min.js', config('app.https'))}}"></script>
<script defer src="{{asset('front_side/js/front.js?v3', config('app.https'))}}"></script>
<script defer>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@stack('javascript')
</html>
