@extends('admin.layouts.app')

@section('content')
    <!-- Page Heading -->

    @if(isset($kitchen))
        {!! Form::open(['route' => ['admin::kitchens.update', $kitchen->id], 'method' => 'PUT', 'files' => true]) !!}
    @else
        {!! Form::open(['route' => ['admin::kitchens.store'], 'method' => 'POST', 'files' => true]) !!}
    @endif
    {!! Form::token() !!}
    <div class="container row align-items-center justify-content-between mb-4">
        <h1 class="h5 text-gray-800">{{trans('admin.menu.kitchens')}}
            > @if(isset($kitchen)){{trans('admin.actions.update')}}@else{{trans('admin.actions.create')}}@endif</h1>
        <button type="submit" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i>
            {{trans('admin.actions.save')}}
        </button>
    </div>

    <div class="container-fluid">
        @if($errors->hasBag())
            <div class="card mb-4 pl-3 py-3 border-left-danger">
                <span>
                    {{$errors->first()}}
                </span>
            </div>
        @endif

        <div class="tab-content">
            <div id="kitchen" class="tab-pane active"><br>
                <div class="form-group row">
                    <div class="col-6 col-sm-6 col-md-4 mb-3 mb-sm-0">
                        {!! Form::label('title', trans('admin.kitchen.title')); !!}
                        {!! Form::text('title', isset($kitchen) ? $kitchen->title : '',[
                            'placeholder' => trans('admin.kitchen.title'),
                            'class' => 'form-control form-control-user'
                        ]); !!}
                    </div>
                    <div class="col-6 col-sm-6 col-md-4 mb-3 mb-sm-0">
                        {!! Form::label('spot_id', trans('admin.kitchen.spot_id')); !!}
                        {!! Form::text('spot_id', isset($kitchen) ? $kitchen->spot_id : '',[
                            'placeholder' => trans('admin.kitchen.spot_id'),
                            'class' => 'form-control form-control-user'
                        ]); !!}
                    </div>
                    <div class="col-6 col-sm-6 col-md-4 mb-3 mb-sm-0">
                        {!! Form::label('address', trans('admin.kitchen.address')); !!}
                        {!! Form::text('address', isset($kitchen) ? $kitchen->address : '',[
                            'placeholder' => trans('admin.kitchen.address'),
                            'class' => 'form-control form-control-user'
                        ]); !!}
                    </div>
                    <div class="col-6 col-md-4 col-md-4 mb-3 mb-sm-0">
                        {!! Form::label('phone', trans('admin.kitchen.phone')); !!}
                        {!! Form::text('phone', isset($kitchen) ? $kitchen->phone : '',[
                            'placeholder' => trans('admin.kitchen.phone'),
                            'class' => 'form-control form-control-user'
                        ]); !!}
                    </div>

                    <div class="col-6 mb-3 mb-sm-0">
                        {!! Form::label('email', trans('admin.kitchen.email')); !!}
                        {!! Form::text('email', isset($kitchen) ? $kitchen->email : '',[
                            'placeholder' => trans('admin.kitchen.email'),
                            'class' => 'form-control form-control-user'
                        ]); !!}
                    </div>

                    <div class="col-6 mb-3 mb-sm-0">
                        {!! Form::label('city_id', trans('admin.kitchen.city')); !!}
                        {!! Form::select('city_id', $cities->toArray(), $kitchen->city_id ?? null, [
                            'placeholder' =>  'Виберіть місто',
                            'class' => 'form-control form-control-user'
                        ]); !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="mb-3 mb-sm-0">
                        {!! Form::label('description', trans('admin.kitchen.description')); !!}
                        {!! Form::textarea('description', isset($kitchen) ? $kitchen->description : '',[
                            'placeholder' => trans('admin.kitchen.description'),
                            'class' => 'form-control form-control-user'
                        ]); !!}
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="container-fluid mt-4 mt-md-4 mt-sm-4">
        <h4>ДОСТАВКА В МІСТА</h4>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-10 mb-3 mb-sm-0">
                {!! Form::label('cities', trans('admin.kitchen.city')); !!}
                {!! Form::select('cities', $cities->toArray(), [] ?? null, [
                    'placeholder' => 'Виберіть місто',
                    'class' => 'form-control form-control-user',
                ]); !!}
            </div>
        </div>


        <div id="selected-cities">
            @if(isset($kitchen))
                @foreach($kitchen->cities as $city)
                    <div class="row mt-3" id="city-block-{{$city->id}}">
                        <div class="input-group col-12 col-sm-12 col-md-10">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">{{$city->name}}</span>
                            </div>
                            <input name="delivery[{{$city->id}}][price_delivery]" type="number" class="form-control"
                                   placeholder="Сума (грн)" value="{{$city->pivot->price_delivery}}">
                            <input name="delivery[{{$city->id}}][time_delivery]" type="text" class="form-control"
                                   placeholder="Час (хв)" value="{{$city->pivot->time_delivery}}">
                            <div class="input-group-prepend pointer-cursor" id="delete-price" data-id="{{$city->id}}">
                                <button class="btn btn-danger">X</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

    </div>

    {!! Form::close() !!}

@endsection

@push('scripts')
    <script>
        $(document).on('change', '#cities', function (selected) {
            const index = selected.currentTarget.selectedIndex;
            const element = selected.currentTarget[index];

            const city_id = element.value;
            const city_name = element.text;

            console.log(city_id, city_name);

            const price_element = `<div class="row mt-3" id="city-block-` + city_id + `">
                <div class="input-group col-12 col-sm-12 col-md-10">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">` + city_name + `</span>
                    </div>
                    <input name="delivery[` + city_id + `][price_delivery]" type="number" class="form-control" placeholder="Сума (грн)">
                    <input name="delivery[` + city_id + `][time_delivery]" type="text" class="form-control" placeholder="Час (хв)">
                    <div class="input-group-prepend pointer-cursor" id="delete-price" data-id="` + city_id + `">
                        <button class="btn btn-danger">X</button>
                    </div>
                </div>
            </div>`;

            if ($('#city-block-' + city_id).length === 0) {
                $('#selected-cities').append(price_element);
            }
            selected.currentTarget.selectedIndex = 0;
        });

        $(document).on('click', '#delete-price', function (item) {
            $('#city-block-' + this.dataset.id).remove();
        });
    </script>
@endpush
