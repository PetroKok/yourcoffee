@extends('app.layouts.app')

@section('content')
    <div class="container" id="full-cart">
        <h2 class="mt-3 mt-sm-3 mt-md-4 mt-lg-4 mb-3 text-center text-white cart-title">Успішне оформлення замовлення</h2>

        @foreach($order->lines as $cart)
            <div class="row text-white d-flex justify-content-between align-items-center pt-2 mt-2 position-relative"
                 id="cart-line-{{$cart['product']['id']}}" style="border-top: 1px solid #ffffff40;">
                <span class="delete-cart-item fas fas-times">
                    <i class="fas fa-times"></i>
                </span>
                <div class="col-3 col-sm-2 pl-0">
                    <img src="{{$cart['product']['image']}}" width="100" alt="{{$cart['product']['name']}}">
                </div>

                <div class="col-4 cart-product-text pr-0">
                    {{$cart['product']['name']}}
                    <div class="d-md-none d-lg-none mt-2 cart-product-text">
                        <span class="decrease cart-inc-dec" data-product-id="{{$cart['product']['id']}}">-</span>
                        <span id="count-product-{{$cart['product']['id']}}" class="cart-qty">{{$cart['qty']}}</span>
                        <span class="increase cart-inc-dec" style="padding: 0 5px"
                              data-product-id="{{$cart['product']['id']}}">+</span>
                    </div>
                </div>

                <div class="col-2 cart-product-text d-none d-md-block d-lg-block">
                    <span class="decrease cart-inc-dec" data-product-id="{{$cart['product']['id']}}">-</span>
                    <span id="count-product-mobile-{{$cart['product']['id']}}">{{$cart['qty']}}</span>
                    <span class="increase cart-inc-dec" style="padding: 0 5px"
                          data-product-id="{{$cart['product']['id']}}">+</span>
                </div>

                <div class="col-5 col-sm-4">
                    <div class="d-flex justify-content-between align-items-center flex-column flex-sm-row">
                        <div class="cart-product-text">
                            <span id="price-{{$cart['product']['id']}}">{{$cart['price']}}</span> грн
                        </div>
                        <div class="cart-product-text">
                            <span id="amount-{{$cart['product']['id']}}">{{$cart['amount']}}</span> грн
                        </div>
                    </div>
                </div>


            </div>
        @endforeach

    </div>

@endsection

@push('javascript')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="{{asset('front_side/js/cart.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.js-example-basic-single').select2({tags: true});
            $('.js-select-payment-type').select2({minimumResultsForSearch: -1});
        });
    </script>
@endpush
