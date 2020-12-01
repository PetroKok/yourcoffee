@extends('app.layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{asset('front_side/css/swiper.css', config('app.https'))}}">
@endpush


@section('content')
    {{--    <div class="bg-image"></div>--}}

    @include('app.components.carousel')

    @include('app.components.cart-button')

    <div class="container">

        @foreach($products as $item)
            <h2 class="mt-5 mb-3 text-center text-white">{{$item[0]->category_name}}</h2>

            <div class="d-flex flex-wrap justify-content-around">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach($item as $key => $product)
                            @if(!empty($product->price))
                                <div class="swiper-slide">
                                    <div class="card ml-md-5 mr-md-5" style="/*width: 18rem;*/">
                                        <span class="card-body text-white">{{$product->product_name}}</span>
                                        <span
                                            class="card-body brand-color price">{{ ((array)$product->price)[1]/100 }}грн</span>
                                        <img
                                            src="{{asset('images/site-images/zaglushka.svg', config('app.https'))}}"                                            class="card-img-top swiper-lazy"
                                            data-src="{{$product->photo ? 'https://joinposter.com'.$product->photo_origin : asset('images/site-images/zaglushka.svg', config('app.https'))}}"
                                            height="350"
                                            alt="Card image cap">
                                        <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
                                        <div class="card-body">
                                            <p class="card-text d-flex text-white">{{$product->description ?? 'Тут мав би бути опис, але нажаль автор його не написав('}}</p>
                                        </div>
                                        <div class="card-body">
                                            <button data-product-id="{{$product->product_id}}"
                                                    class="btn btn-outline btn-orange mt-1 add_to_cart">
                                                До кошика
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="brand-color swiper-button-next tours-btn_next"></div>
                    <div class="brand-color swiper-button-prev tours-btn_prev"></div>
                </div>


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
            breakpoints: {
                450: {
                    slidesPerView: 1,
                    spaceBetween: 20
                },
                480: {
                    slidesPerView: 2,
                    spaceBetween: 30
                }
            },

            // Disable preloading of all images
            preloadImages: false,
            // Enable lazy loading
            lazy: true
        });
    </script>
@endpush
