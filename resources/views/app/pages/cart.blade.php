@extends('app.layouts.app')


@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
@endpush

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
        <h2 class="mt-3 mt-sm-3 mt-md-4 mt-lg-4 mb-3 text-center text-white cart-title">Корзина</h2>

        @foreach($carts as $cart)
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
        <div class="row mt-2 mb-2" style="border-top: 1px solid #ffffff40;"></div>

        <div class="d-flex justify-content-between align-items-center text-white cart-product-text">
            <span>Загальна сума:</span>
            <span><span id="full-amount">{{$full_amount}}</span> грн</span>
        </div>

        <div class="d-flex justify-content-between align-items-center text-white cart-product-text">
            <span>Доставка:</span>
            <span><span id="delivery-amount">0</span> грн</span>
        </div>

        <div class="d-flex justify-content-between align-items-center text-white cart-product-text">
            <span>Адреса кухні:</span>
            <span id="kitchen-address"></span>
        </div>

        <div class="row mt-2 mb-4" style="border-top: 1px solid #ffffff40;"></div>

        {{ Form::open(['url' => '/cart/order', 'method' => 'POST']) }}

        @include('app.components.cart.city-form', [
            'data' => $cities->toArray(true),
            'name' => 'city_id',
            'id' => 'city_id',
            'placeholder' => 'Виберіть місто',
        ])

        <div class="d-flex justify-content-center cart-product-text">
            <label class="text-white pointer-cursor delivery" style="margin-right: 18%" for="delivery">Доставка</label>
            <label class="text-white pointer-cursor self-pickup" for="self-pickup">Самовивіз</label>
        </div>


        <div class="d-flex justify-content-center">
            <input type="radio" class="is_delivery_radio" id="delivery" name="order" checked value="delivery"/>
            <label class="text-white" for="delivery" id="delivery-label"></label>
            <input type="radio" class="is_delivery_radio" id="self-pickup" name="order" value="self-pickup"/>
            <label class="text-white" for="self-pickup" id="self-pickup-label"></label>
        </div>

        <div class="cart-element mt-4">
            {!! Form::text('phone', null, [
                'placeholder' => trans('app.fields.phone'),
                'class' => 'text-white mb-3'
            ]); !!}
        </div>
        <div class="cart-element">
            {!! Form::text('name', null, [
                'placeholder' => trans('app.fields.name'),
                'class' => 'text-white mb-3'
            ]); !!}
        </div>
        <div class="cart-element" id="tab-delivery">
            {!! Form::text('address', null, [
                'placeholder' => trans('app.cart.address'),
                'class' => 'text-white mb-3'
            ]); !!}


            @include('app.components.cart.city-form', [
                'data' => [1=> 'Картою', 2 => 'Накладним платежем'],
                'name' => 'pay_type',
                'id' => 'pay_type',
                'placeholder' => 'Виберіть спосіб оплати',
                'class' => 'js-select-payment-type',
            ])

            <div class="d-flex mb-3">
                <input type="checkbox" class="is_delivery_radio" id="notcallme" name="call" value="true"/>
                <label class="text-white radio-call-me" for="notcallme" id="delivery-label"></label>
                <span class="text-white cart-product-text"><span class="pl-3">Не передзвонювати мені</span>
                    <i>(в такому випадку оплата буде здійснюватись онлайн)</i></span>
            </div>
            <div class="d-flex cart-element">
                {!! Form::text('apartment', null, [
                   'placeholder' => trans('app.cart.apartment'),
                   'class' => 'text-white mb-3 width-50 mr-2'
               ]); !!}

                {!! Form::text('entrance', null, [
                   'placeholder' => trans('app.cart.entrance'),
                   'class' => 'text-white mb-3 width-50 ml-2'
               ]); !!}
            </div>

            <div class="d-flex cart-element">
                {!! Form::text('floor', null, [
                   'placeholder' => trans('app.cart.floor'),
                   'class' => 'text-white mb-3 width-50 mr-2'
               ]); !!}

                {!! Form::text('door_code', null, [
                   'placeholder' => trans('app.cart.door_code'),
                   'class' => 'text-white mb-3 width-50 ml-2'
               ]); !!}
            </div>

        </div>


        <div class="d-flex justify-content-center mt-4 mt-md-4">
            <button type="submit" class="btn btn-yellow" id="make-order">Оформити замовлення (<span
                    id="total-amount">{{$full_amount}}</span>грн)
            </button>
        </div>

        {{ Form::close() }}

    </div>

@endsection

@push('javascript')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="{{asset('front_side/js/cart.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.js-example-basic-single').select2({tags: true});
            $('.js-select-payment-type').select2();
        });
    </script>
@endpush
