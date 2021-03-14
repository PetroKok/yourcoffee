@extends('app.layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{asset('front_side/css/swiper.css', config('app.https'))}}">
@endpush


@section('content')

    @include('app.components.carousel')

    @include('app.components.cart-button')

    <div class="container" id="home" style="opacity: 0; width: 100%">

        @foreach($products as $key => $item)
            <h2 class="mt-5 mb-3 text-center text-white diagonal-box family-bold">{{reset($item)->category_name}}</h2>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach($item as $key => $product)
                        @if(!empty($product->price))
                            <div class="swiper-slide align-items-stretch">
                                <div class="card ml-md-5 mr-md-5" style="margin: 0 auto">
                                    <h5 class="card-body text-white family-bold mb-0">{{$product->product_name}}</h5>

                                    <img
                                        {{--                                            src="{{asset('images/site-images/zaglushka.svg', config('app.https'))}}"--}}
                                        class="card-img-top m-auto swiper-lazy"
                                        src="{{$product->photo_origin ? '/assets/poster'.$product->photo_origin : asset('images/site-images/zaglushka.svg', config('app.https'))}}"
                                        {{--                                            data-src="{{$product->photo_origin ? '/assets/poster'.$product->photo_origin : asset('images/site-images/zaglushka.svg', config('app.https'))}}"--}}
                                        style="max-width: 350px; height: 300px; object-fit: cover"
                                        alt="Card image cap"
                                        loading="lazy">
                                    {{--                                        <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>--}}
                                    <div class="d-flex">
                                        <p class="card-text text-center text-white family-light pl-2 pr-2">{{config("descriptions.$product->product_id")}}</p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <button
                                            data-product-id="{{$product->product_id}}"
                                            class="btn btn-outline btn-yellow mt-4 ml-2 family-medium home-cart-btn card-text add_to_cart">
                                            Замовити
                                        </button>
                                        <span
                                            class="text-white family-medium mt-4">{{ ((array)$product->price)[1]/100 }} грн</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="brand-color swiper-button-next tours-btn_next"></div>
                <div class="brand-color swiper-button-prev tours-btn_prev"></div>
            </div>
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
