@extends('app.layouts.app')


@push('styles')
    <link href="{{asset('css/profile.css', config('app.https'))}}" rel="stylesheet"/>
@endpush

@section('content')
    <div class="container" id="empty-cart">
        <h2 class="mt-5 mb-3 text-center text-white">Профіль</h2>

        <div class="d-flex">
            <div class="col-4 m-1 pb-4 brand-background-color">
                <div class="mt-3">
                    <div class="profile-image">
                        <img
                            src="https://boostchiropractic.co.nz/wp-content/uploads/2016/09/default-user-img.jpg"
                            alt="profile-image"
                            class="img-thumbnail"
                            style="width: 100%"
                        />
                    </div>
                    <div class="customer-information mt-3 text-black ml-3">
                        <div class="customer-name">{{$customer->name.' '.$customer->surname}}</div>
                        <div class="customer-name mt-2">+{{$customer->phone}}</div>
                        <div class="customer-name mt-2">{{$customer->email}}</div>
                    </div>
                </div>
            </div>


            <div class="col-8 m-1 brand-background-color">
                <h2 class="mt-3 text-center text-black">Адреси</h2>
                <div class="mt-3">
                    <div class="add-address">+</div>
                </div>
            </div>
        </div>
    </div>
@endsection
