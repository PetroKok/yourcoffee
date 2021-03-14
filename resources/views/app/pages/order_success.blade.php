@extends('app.layouts.app')

@section('content')
    <div class="container" id="full-cart">
        <h2 class="mt-3 mt-sm-3 mt-md-4 mt-lg-4 mb-3 text-center text-white cart-title">Замовлення оформлено</h2>

        @foreach($order->lines as $cart)
            <div class="row text-white d-flex justify-content-between align-items-center pt-2 mt-2 position-relative"
                 id="cart-line-{{$cart['product']['product_id']}}"
                 style="border-top: 1px solid #ffffff40;">
                <span class="delete-cart-item fas fas-times">
                    <i class="fas fa-times"></i>
                </span>
                <div class="col-3 col-sm-2 pl-0">
                    <img src="{{$cart['product']->get('photo') ? 'https://joinposter.com'.$cart['product']->get('photo') : asset('images/site-images/zaglushka.svg', config('app.https'))}}" width="100" alt="{{$cart['product']['product_name']}}">
                </div>

                <div class="col-4 col-sm-3 cart-product-text pr-0">
                    {{$cart['product']['product_name']}}
                </div>

                <div class="d-md-none d-lg-none cart-product-text">
                    <span id="count-product-{{$cart['product']['product_id']}}">{{$cart['qty']}}х</span>
                </div>

                <div class="col-3 cart-product-text d-none d-md-block d-lg-block text-center">
                    <span id="count-product-mobile-{{$cart['product']['product_id']}}" class="cart-product-text">{{$cart['qty']}}х</span>
                </div>

                <div class="col-3 col-sm-3">
                    <div class="d-flex justify-content-between align-items-center flex-column flex-sm-row">
                        <div class="cart-product-text">
                            <span id="amount-{{$cart['product']['product_id']}}">{{$cart['amount']}}</span> грн
                        </div>
                    </div>
                </div>

            </div>
        @endforeach
        <div class="row" style="border-bottom: 1px solid #ffffff40;"></div>
        <div class="d-flex mt-3 justify-content-between align-items-center text-white cart-product-text">
            <span>Cума:</span>
            <span><span id="full-amount">{{$order->amount}}</span> грн</span>
        </div>

        @if($order->type !== \App\Models\Order::ORDER_TYPE['SELF-PICKUP'])
            <div class="d-flex justify-content-between align-items-center text-white cart-product-text">
                <span>Доставка:</span>
                <span>
                    @if(isset($city['price_delivery']))
                        <span id="delivery-amount">{{$city['price_delivery']}}</span> грн
                    @else
                        <span id="delivery-amount">{{trans('app.cart.specify')}}</span>
                    @endif
            </span>
            </div>
        @endif

        @if($order->type === \App\Models\Order::ORDER_TYPE['SELF-PICKUP'])
            <div class="d-flex justify-content-between align-items-center text-white cart-product-text">
                <span>Адреса кухні:</span>
                <span id="kitchen-address">
                    @if(isset($city['address']))
                        {{$city['address']}}
                    @else
                        {{trans('app.cart.specify')}}
                    @endif
                </span>
            </div>
        @else
            <div class="d-flex justify-content-between align-items-center text-white cart-product-text">
                <span>Ваша адреса:</span>
                <span id="kitchen-address">{{$order->address}}</span>
            </div>
            <div class="d-flex justify-content-between align-items-center text-white cart-product-text">
                <span>Місто:</span>
                <span
                    id="kitchen-address">@if(isset($city['city'])) {{$city['city']}} @else {{$order->city}} @endif</span>
            </div>
        @endif

        @if($order->type !== \App\Models\Order::ORDER_TYPE['SELF-PICKUP'])
            @if(isset($city['price_delivery']))
                <h3 class="mt-3 mt-sm-3 mt-md-4 mt-lg-4 mb-3 text-center text-white cart-title">
                    Загальна сума до сплати: <span class="brand-color">{{(int) $order->amount + (int) $city['price_delivery']}} грн</span>
                </h3>
            @else
                <h3 class="mt-3 mt-sm-3 mt-md-4 mt-lg-4 mb-3 text-center text-white cart-title">
                    Загальна сума до сплати: <span
                        class="brand-color">{{$order->amount}} грн + {{trans('app.cart.delivery')}}</span>
                </h3>
            @endif
        @else
            @if(isset($city['price_delivery']))
                <h3 class="mt-3 mt-sm-3 mt-md-4 mt-lg-4 mb-3 text-center text-white cart-title">
                    Загальна сума до сплати: <span class="brand-color">{{(int) $order->amount}} грн</span>
                </h3>
            @else
                <h3 class="mt-3 mt-sm-3 mt-md-4 mt-lg-4 mb-3 text-center text-white cart-title">
                    Загальна сума до сплати: <span
                        class="brand-color">{{$order->amount}}</span>
                </h3>
            @endif
        @endif

    </div>

@endsection

@push('javascript')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="{{asset('front_side/js/cart.js', config('app.https'))}}"></script>
    <script>
        $(document).ready(function () {
            $('.js-city-select2').select2({tags: true});
            $('.js-select-payment-type').select2({minimumResultsForSearch: -1});
        });
    </script>
@endpush
