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
                <div id="accordion">


                    <button class="add-address mb-3" type="button" data-toggle="modal" data-target="#add-address">+
                    </button>


                    @foreach($addresses as $address)
                        <div class="card">
                            <div class="card-header p-2" id="heading{{$loop->index}}" data-toggle="collapse"
                                 data-target="#collapse{{$loop->index}}"
                                 aria-expanded="{{$loop->first ? 'true' : 'false'}}"
                                 aria-controls="collapse{{$loop->index}}">
                                <div
                                    class="row">
                                    <div class="col-lg-1 col-md-1 col-1 d-flex align-items-center">
                                        <input class="d-none address-main" type="radio" name="main"
                                               id="address-{{$address->id}}"
                                               value="{{$address->id}}"
                                               @if($address->main) checked @endif/>
                                        <label class="text-white radio-call-me radio-button-address m-0 mr-3"
                                               for="address-{{$address->id}}"
                                               id="delivery-label"></label>
                                    </div>
                                    <p class="col-lg-11 col-md-11 col-11 m-0">
                                        #{{$loop->index + 1}} {{trans('app.shortcut.city')}}{{$address->city->name}}
                                        , {{trans('app.shortcut.street')}} {{$address->address}}{{$address->apartment ? ', '.trans('app.shortcut.apartment').' '.$address->apartment : ''}}{{$address->entrance ? ', '.trans('app.shortcut.entrance').' '.$address->entrance : ''}}{{$address->floor ? ', '.trans('app.shortcut.floor').' '.$address->floor : ''}}{{$address->door_code ? ', '.trans('app.shortcut.door_code').' '.$address->door_code : ''}}
                                        .</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="add-address" tabindex="-1" role="dialog" aria-labelledby="AddAddress"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex">
                        @include('app.components.cart.city-form', [
                            'data' => $cities->toArray(true),
                            'name' => 'city_id',
                            'id' => 'city_id',
                               'class' => 'js-city-select2 d-flex',
                            'placeholder' => 'Виберіть місто',
                        ])
                        {!! Form::text('address', null, [
                            'placeholder' => trans('app.cart.address'),
                            'class' => 'text-white mb-3'
                        ]); !!}
                    </div>
                    <div class="d-flex">
                        {!! Form::text('apartment', null, [
                           'placeholder' => trans('app.cart.apartment'),
                           'class' => 'text-white mb-3 width-50 mr-2'
                       ]); !!}
                        {!! Form::text('entrance', null, [
                           'placeholder' => trans('app.cart.entrance'),
                           'class' => 'text-white mb-3 width-50 ml-2'
                       ]); !!}
                    </div>

                    <div class="d-flex">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <script src="{{asset('front_side/js/profile.js', config('app.https'))}}"></script>
@endpush
