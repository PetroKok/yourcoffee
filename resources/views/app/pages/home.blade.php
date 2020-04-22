@extends('app.layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{asset('front_side/css/swiper.css')}}">
@endpush

@section('content')
    <div class="container">

        @foreach($categories as $category)

            <h2 class="mt-5 mb-3 text-center text-white">{{$category->title}}</h2>

            <div class="d-flex flex-wrap justify-content-around">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach($category->products as $product)
                            <div class="swiper-slide">
                                <div class="card ml-md-5 mr-md-5" style="/*width: 18rem;*/">
                                    <span class="card-body text-white">{{$product->name}}</span>
                                    <span class="card-body brand-color price">{{$product->price}} грн</span>
                                    <img class="card-img-top"
                                         src="{{$product->image}}"
                                         alt="Card image cap">
                                    <div class="card-body">
                                        <p class="card-text d-flex text-white">{{$product->description}}</p>
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
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">

        </div>
    </div>

@endsection


@push('javascript')
    <script src="{{asset('front_side/js/swiper.js')}}"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 2,
            spaceBetween: 50,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>
@endpush
