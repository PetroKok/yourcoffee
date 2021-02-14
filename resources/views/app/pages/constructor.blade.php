@extends('app.layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{asset('front_side/css/swiper.css', config('app.https'))}}">
@endpush


@section('content')
    <div class="container family-medium" id="home">
        <h1 class="text-white text-center mt-5">Конструктор</h1>
        <h5 class="brand-color text-center mt-5">Скоро...</h5>

        <img src="{{asset('images/site-images/fon.jpeg', config('app.https'))}}"
             class="mt-5"
             style="
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 80%;
            "
             alt="Constructor picture your burger">
    </div>
@endsection
