@extends('app.layouts.app')


@push('styles')
    <link href="{{asset('css/profile.css', config('app.https'))}}" rel="stylesheet"/>
@endpush

@section('content')
    <div class="container" id="empty-cart">
        <h2 class="mt-3 mb-3 text-center text-white">Профіль</h2>

        <div class="row">
            @include('app.components.profile.profile-sidebar')

            <div class="col-12 col-md-8 p-0 brand-background-color">
                <h2 class="mt-4 mb-4 mt-md-3 mb-md-3 text-center text-black profile-title">Історія замовлення</h2>
                <div id="accordion">
                    @foreach($orders as $order)
                        <div class="card">
                            <div class="card-header pointer-cursor" id="heading{{$loop->index}}" data-toggle="collapse"
                                 data-target="#collapse{{$loop->index}}"
                                 aria-expanded="{{$loop->first ? 'true' : 'false'}}"
                                 aria-controls="collapse{{$loop->index}}">
                                <h5 class="mb-0 row">
                                    <div
                                        class="col-lg-5 col-md-5 col-6 order-title d-flex justify-content-between flex-column flex-lg-row">
                                        <span>Замовлення #{{$order->id}} </span>
                                        <span>{{ $order->created_at->format('d M H:s')}}</span>
                                    </div>
                                    <div class="row col-lg-7 col-md-7 col-6 p-0">
                                        <a class="col-lg-5 col-md-5 col-sm-4 col-12 order-amount text-lg-center text-md-center text-right p-0">
                                            {{$order->amount}} грн
                                        </a>
                                        <a class="col-lg-7 col-md-7 col-sm-8 col-12 order-status text-right p-0"
                                           style="color: {{trans('app.status.color.'.$order->status)}}">
                                            <b>{{trans('app.status.'.$order->status)}}</b>
                                        </a>
                                    </div>
                                </h5>
                            </div>
                            <div id="collapse{{$loop->index}}" class="collapse {{!$loop->first ?'': 'show'}}"
                                 aria-labelledby="heading{{$loop->index}}"
                                 data-parent="#accordion">
                                @foreach($order->lines as $line)
                                    <div
                                        class="d-flex justify-content-between align-items-center position-relative order-product-title"
                                        id="cart-line-{{$line->product->id}}"
                                        style="border-bottom: 1px solid #ffffff40;">
                                        <div class="col-2 col-sm-2 pl-0">
                                            <img src="{{$line->product->image}}" class="order-product-image"
                                                 alt="{{$line->product->name}}">
                                        </div>

                                        <div class="col-4 cart-product-text pr-0">
                                            {{$line->product->name}}
                                        </div>

                                        <div class="col-5 col-sm-4 p-0">
                                            <div class="d-flex justify-content-around">
                                                <div class="cart-product-text">
                                                    <span id="price-{{$line->product->id}}">{{$line->qty}}</span>x
                                                </div>
                                                <div class="cart-product-text">
                                                    <span id="amount-{{$line->product->id}}">{{$line->price}}</span> грн
                                                </div>
                                                <div class="cart-product-text">
                                                    <span
                                                        id="amount-{{$line->product->id}}">{{$line->price * $line->qty}}</span>
                                                    грн
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
@endsection
