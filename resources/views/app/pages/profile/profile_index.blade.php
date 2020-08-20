@extends('app.layouts.app')


@push('styles')
    <link href="{{asset('css/profile.css', config('app.https'))}}" rel="stylesheet"/>
@endpush

@section('content')
    <div class="container" id="empty-cart">
        <h2 class="mt-5 mb-3 text-center text-white">Профіль</h2>

        <div class="row">
            @include('app.components.profile.profile-sidebar')

            <div class="col-12 col-md-8 brand-background-color">
                <h2 class="mt-3 text-center text-black">Адреси</h2>
                <div class="mt-3">
                    <div class="add-address">+</div>
                </div>
            </div>
        </div>
    </div>
@endsection
