@extends('app.layouts.app')

@section('content')
    <div class="container">

        @foreach(['Бургери','Cнеки','Cнеки','Cнеки','Cнеки'] as $key)

            <h2 class="mt-5 mb-5 text-center text-white">{{$key}}</h2>

            <div class="d-flex flex-wrap justify-content-around">

                @foreach([1,2] as $key)

                    <div class="card" style="width: 18rem;">
                        <span class="card-body text-white">BURGER'S NAME</span>
                        <span class="card-body brand-color price">80 грн</span>
                        <img class="card-img-top"
                             src="{{asset('images/site-images/burger.png')}}"
                             alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text d-flex text-white">Some quick example text to build on the card
                                title and make up the bulk of the card's content.</p>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-outline btn-orange mt-1 ">
                                До кошика
                            </button>
                        </div>
                    </div>

                @endforeach

            </div>

        @endforeach

    </div>
@endsection
