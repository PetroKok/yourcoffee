@extends('app.layouts.app')


@section('content')
    <div class="container {{count($carts) === 0 ?'':'d-none'}}" id="empty-cart">
        <h2 class="mt-5 mb-3 text-center text-white">Ваша корзина пуста</h2>
        <div class="d-flex justify-content-center mt-5">
            <img src="{{asset('images/site-images/static/cart_empty.png')}}" width="190" alt="">
        </div>
        <h3 class="mt-5 mb-3 text-center text-white">
            <a href="{{route('home')}}" class="btn btn-yellow">Перейти на головну сторінку</a>
        </h3>
    </div>



    <div class="container {{count($carts) !== 0 ?'':'d-none'}}" id="full-cart">
        <h2 class="mt-3 mt-sm-3 mt-md-4 mt-lg-4 mb-3 text-center text-white">Оформлення замовлення</h2>

        @foreach($carts as $cart)
            <div class="text-white d-flex justify-content-between align-items-center"
                 id="cart-line-{{$cart['product_id']}}" style="border-top: 1px solid #ffffff40;">
                <div class="mr-md-3 mr-lg-3">
                    <img src="{{$cart['product']['image']}}" width="100" alt="{{$cart['product']['name']}}">
                </div>

                <div class="mr-md-5 mr-lg-5 cart-product-text">
                    {{$cart['product']['name']}}
                    <div class="d-md-none d-lg-none mt-2 cart-product-text">
                        <span class="decrease cart-inc-dec" data-product-id="{{$cart['product_id']}}">-</span>
                        <span id="count-product-{{$cart['product_id']}}" class="cart-qty">{{$cart['qty']}}</span>
                        <span class="increase cart-inc-dec" style="padding: 0 5px"
                              data-product-id="{{$cart['product_id']}}">+</span>
                    </div>
                </div>

                <div class="mr-3 mr-3 cart-product-text d-none d-md-block d-lg-block">
                    <span class="decrease cart-inc-dec" data-product-id="{{$cart['product_id']}}">-</span>
                    <span id="count-product-{{$cart['product_id']}}">{{$cart['qty']}}</span>
                    <span class="increase cart-inc-dec" style="padding: 0 5px"
                          data-product-id="{{$cart['product_id']}}">+</span>
                </div>


                <div class="mr-md-3 mr-lg-3 cart-product-text">
                    {{$cart['price']}} грн
                </div>

                <div class="mr-md-3 mr-lg-3 cart-product-text">
                    {{$cart['amount']}} грн
                </div>
            </div>
        @endforeach
        <hr class="cart-items-divider">
    </div>

@endsection
