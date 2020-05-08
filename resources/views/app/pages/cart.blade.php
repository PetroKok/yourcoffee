@extends('app.layouts.app')


@section('content')
    <div class="container">
        <h2 class="mt-5 mb-3 text-center text-white">Оформлення замовлення</h2>

        @foreach($carts as $cart)
            <div class="text-white d-flex justify-content-between align-items-center" id="cart-line-{{$cart['product_id']}}" style="border-top: 1px solid #ffffff40;">
                <div class="mr-3">
                    <img src="{{$cart['product']['image']}}" width="100" alt="{{$cart['product']['name']}}">
                </div>

                <div class="mr-5">
                    {{$cart['product']['name']}}
                </div>

                <div class="mr-3">
                    <span class="decrease cart-inc-dec" data-product-id="{{$cart['product_id']}}">-</span>
                    <span id="count-product-{{$cart['product_id']}}">{{$cart['qty']}}</span>
                    <span class="increase cart-inc-dec" style="padding: 0 5px" data-product-id="{{$cart['product_id']}}">+</span>
                </div>

                <div class="mr-3">
                    {{$cart['price']}} грн
                </div>

                <div class="mr-3">
                    {{$cart['amount']}} грн
                </div>
            </div>
        @endforeach
        <hr class="cart-items-divider">
    </div>

@endsection
