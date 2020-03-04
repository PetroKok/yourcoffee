@extends('admin.layouts.app')

@section('content')
    <!-- Page Heading -->

    @if(isset($product))
        {!! Form::open(['route' => ['admin::products.update', $product->id], 'method' => 'PUT', 'files' => true]) !!}
    @else
        {!! Form::open(['route' => ['admin::products.store'], 'method' => 'POST', 'files' => true]) !!}
    @endif
    {!! Form::token() !!}
    <div class="container row align-items-center justify-content-between mb-4">
        <h1 class="h5 text-gray-800">{{trans('admin.menu.products')}}
            > @if(isset($product)){{trans('admin.actions.update')}}@else{{trans('admin.actions.create')}}@endif</h1>
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

        <ul class="nav nav-tabs">
            @foreach($locales as $locale)
                <li class="nav-item">
                    <a class="nav-link {{!$loop->first ?: "active"}}" data-toggle="tab"
                       href="#{{$locale}}">{{mb_strtoupper($locale)}}</a>
                </li>
            @endforeach
        </ul>

        <div class="tab-content">
            @foreach($locales as $locale)
                <div id="{{$locale}}" class="tab-pane {{!$loop->first ? "fade": "active"}}"><br>
                    <div class="form-group row">
                        <div class="col mb-3 mb-sm-0">
                            {!! Form::label('name', trans('admin.product.name')); !!}
                            {!! Form::text($locale.'[name]', isset($product) ? $product->translate($locale, true)->name : '',[
                                'placeholder' => trans('admin.product.name'),
                                'class' => 'form-control form-control-user'
                            ]); !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col mb-3 mb-sm-0">
                            {!! Form::label('description', trans('admin.product.description')); !!}
                            {!! Form::textarea($locale.'[description]', isset($product) ? $product->translate($locale, true)->description : '',[
                                'placeholder' => trans('admin.product.description'),
                                'class' => 'form-control form-control-user'
                            ]); !!}
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="form-group row">
                <div class="col-md-4 mb-3 mb-sm-0">
                    {!! Form::label('price', trans('admin.product.price')); !!}
                    {!! Form::text('price', isset($product) ? $product->price : '100',[
                        'placeholder' => trans('admin.product.price'),
                        'class' => 'form-control form-control-user'
                    ]); !!}
                </div>
                <div class="col-md-4 mb-3 mb-sm-0">
                    {!! Form::label('price', trans('admin.product.category')); !!}
                    {!! Form::select('category_id', $categories, isset($product) ? $product->category_id : '',[
                        'placeholder' => trans('admin.product.category'),
                        'class' => 'form-control form-control-user'
                    ]); !!}
                </div>
                <div class="col-md-4 mb-3 mb-sm-0">
                    {!! Form::label('price', trans('admin.product.ingredient')); !!}
                    {!! Form::select('ingredient_ids', $ingredients, isset($product) ? $product->ingredients : '',[
                         'class' => 'form-control form-control-user selectpicker',
                         'multiple'=>'multiple',
                         'name'=>'ingredient_ids[]'
                     ]); !!}
                </div>
            </div>

            {{--            <div class="form-group row">--}}
            {{--                <div class="col-sm-6 mb-3 mb-sm-0">--}}
            {{--                    {!! Form::label('image', trans('admin.product.image')); !!}--}}
            {{--                    {!! Form::file('image', ['class' => 'form-control form-control-user']); !!}--}}
            {{--                    <img src="{{isset($product) ? $product->image : ''}}" id="image-component" alt=""--}}
            {{--                         class="upload-preview">--}}
            {{--                </div>--}}

            {{--                <div class="col-sm-6 mb-3 mb-sm-0">--}}
            {{--                    {!! Form::label('pic', trans('admin.product.pic')); !!}--}}
            {{--                    {!! Form::file('pic', ['class' => 'form-control form-control-user']); !!}--}}
            {{--                    <img src="{{isset($product) ? $product->pic : ''}}" id="pic-component" alt=""--}}
            {{--                         class="upload-preview">--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div>
    </div>

    {!! Form::close() !!}

    @push('scripts')
        <script>
            $("#image").change(function () {
                readURL(this, 'image-component');
            });

            $("#pic").change(function () {
                readURL(this, 'pic-component');
            });
        </script>
    @endpush
@endsection
