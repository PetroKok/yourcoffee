@extends('app.layouts.app')


@push('styles')
    <link href="{{asset('css/profile.css', config('app.https'))}}" rel="stylesheet"/>
@endpush

@section('content')
    <div class="container" id="empty-cart">
        <h2 class="mt-3 mb-3 text-center text-white">Профіль</h2>

        <div class="row">
            @include('app.components.profile.profile-sidebar')

            <div class="col-12 col-md-8 brand-background-color">
                <h2 class="mt-4 mb-4 mt-md-3 mb-md-0 text-center text-black">Історія замовлення</h2>
                <div id="accordion">
                    @foreach($orders as $order)
                        <div class="card">
                            <div class="card-header" id="heading{{$loop->index}}">
                                <h5 class="mb-0">
                                    <a class="{{!$loop->first ?'': 'collapsed'}}" data-toggle="collapse" data-target="#collapse{{$loop->index}}"
                                       aria-expanded="{{$loop->first ? 'true' : 'false'}}"
                                       aria-controls="collapse{{$loop->index}}">
                                        Замовлення #{{$order->id}}
                                    </a>
                                </h5>
                            </div>
                            <div id="collapse{{$loop->index}}" class="collapse {{!$loop->first ?'': 'show'}}"
                                 aria-labelledby="heading{{$loop->index}}"
                                 data-parent="#accordion">
                                @foreach($order->lines as $line)
                                    <div class="d-flex justify-content-between align-items-center position-relative"
                                         id="cart-line-{{$line->product->id}}" style="border-bottom: 1px solid #ffffff40;">
                                        <span class="delete-cart-item fas fas-times">
                                            <i class="fas fa-times"></i>
                                        </span>
                                        <div class="col-3 col-sm-2 pl-0">
                                            <img src="{{$line->product->image}}" width="100" alt="{{$line->product->name}}">
                                        </div>

                                        <div class="col-4 cart-product-text pr-0">
                                            {{$line->product->name}}
                                        </div>

                                        <div class="col-5 col-sm-4 p-0">
                                            <div class="d-flex justify-content-between align-items-center flex-column flex-sm-row">
                                                <div class="cart-product-text">
                                                    <span id="price-{{$line->product->id}}">{{$line->qty}}</span>x
                                                </div>
                                                <div class="cart-product-text">
                                                    <span id="amount-{{$line->product->id}}">{{$line->price}}</span> грн
                                                </div>
                                                <div class="cart-product-text">
                                                    <span id="amount-{{$line->product->id}}">{{$line->price * $line->qty}}</span> грн
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
