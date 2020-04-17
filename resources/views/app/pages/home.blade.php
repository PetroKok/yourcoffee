@extends('app.layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{asset('front_side/css/swiper.css')}}">
@endpush

@section('content')
    <div class="container">

        @foreach(['Бургери','Cнеки','Cнеки','Cнеки','Cнеки'] as $key)

            <h2 class="mt-5 mb-3 text-center text-white">{{$key}}</h2>

            <div class="d-flex flex-wrap justify-content-around">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach([1,2,3,4,5] as $key)
                            <div class="swiper-slide">
                                <div class="card ml-md-5 mr-md-5" style="/*width: 18rem;*/">
                                    <span class="card-body text-white">BURGER'S NAME</span>
                                    <span class="card-body brand-color price">80 грн</span>
                                    <img class="card-img-top"
                                         src="{{asset('images/site-images/burger.png')}}"
                                         alt="Card image cap">
                                    <div class="card-body">
                                        <p class="card-text d-flex text-white">Some quick example text to build on the
                                            card
                                            title and make up the bulk of the card's content.</p>
                                    </div>
                                    <div class="card-body">
                                        <button class="btn btn-outline btn-orange mt-1 ">
                                            До кошика
                                        </button>
                                    </div>
                                </div>
                            </div>
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
    <script src="{{asset('front_side/js/swiper.js')}}"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 2,
            spaceBetween: 50
        });
    </script>
@endpush
