@extends('app.layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{asset('front_side/css/swiper.css', config('app.https'))}}">
@endpush


@section('content')

    @include('app.components.carousel')

    @include('app.components.cart-button')

    <div class="container" id="home" style="opacity: 0; width: 100%">

        @foreach($products as $key => $item)
            @if(!in_array(reset($item)->menu_category_id, [8, 15, 17, 18, 19]))
                <h2 class="mt-5 mb-3 text-center text-white diagonal-box family-bold">{{reset($item)->category_name}}</h2>
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach($item as $key => $product)
                            @if(!empty($product->price))
                                @include('app.components.product-card')
                            @endif

                            @if(!empty($product->modifications))
                                @foreach($product->modifications as $key => $modificator)
                                    @include('app.components.modificator-card')
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                    <div class="brand-color swiper-button-next tours-btn_next"></div>
                    <div class="brand-color swiper-button-prev tours-btn_prev"></div>
                </div>
            @endif
        @endforeach

    </div>

@endsection


@push('javascript')
    <script src="{{asset('front_side/js/swiper.js', config('app.https'))}}"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            // spaceBetween: 50,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            slidesPerView: 1,
            breakpoints: {
                500: {
                    slidesPerView: 2,
                    spaceBetween: 30
                }
            },

            // Disable preloading of all images
            preloadImages: false,
            // Enable lazy loading
            // lazy: true
        });

        $("#home").delay(500).animate({opacity: 1}, 500);
    </script>
@endpush
