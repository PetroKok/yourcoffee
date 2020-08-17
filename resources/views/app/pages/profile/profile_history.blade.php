@extends('app.layouts.app')


@push('styles')
    <link href="{{asset('css/profile.css', config('app.https'))}}" rel="stylesheet"/>
@endpush

@section('content')
    <div class="container" id="empty-cart">
        <h2 class="mt-5 mb-3 text-center text-white">Профіль</h2>

        <div class="d-flex">
            @include('app.components.profile.profile-sidebar')

            <div class="col-8 m-1 brand-background-color">
                <h2 class="mt-3 text-center text-black">Історія замовлення</h2>
                <div class="mt-3">
                    @foreach($orders as $order)
                        <a href="#">{{$order->id}}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
