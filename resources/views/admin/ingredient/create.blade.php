@extends('admin.layouts.app')

@section('content')
    <!-- Page Heading -->

    @if(isset($ingredient))
        {!! Form::open(['route' => ['admin::ingredients.update', $ingredient->id], 'method' => 'PUT', 'files' => true]) !!}
    @else
        {!! Form::open(['route' => ['admin::ingredients.store'], 'method' => 'POST', 'files' => true]) !!}
    @endif
    {!! Form::token() !!}
    <div class="container row align-items-center justify-content-between mb-4">
        <h1 class="h5 text-gray-800">{{trans('admin.menu.ingredients')}}
            > @if(isset($ingredient)){{trans('admin.actions.update')}}@else{{trans('admin.actions.create')}}@endif</h1>
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
                            {!! Form::label('name', trans('admin.ingredient.name')); !!}
                            {!! Form::text($locale.'[name]', isset($ingredient) ? $ingredient->translate($locale, true)->name : 'POMIDOR',[
                                'placeholder' => trans('admin.ingredient.name'),
                                'class' => 'form-control form-control-user'
                            ]); !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col mb-3 mb-sm-0">
                            {!! Form::label('description', trans('admin.ingredient.description')); !!}
                            {!! Form::textarea($locale.'[description]', isset($ingredient) ? $ingredient->translate($locale, true)->description : 'POMIDOR',[
                                'placeholder' => trans('admin.ingredient.description'),
                                'class' => 'form-control form-control-user'
                            ]); !!}
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="form-group row">
                <div class="col mb-3 mb-sm-0">
                    {!! Form::label('price', trans('admin.ingredient.price')); !!}
                    {!! Form::text('price', isset($ingredient) ? $ingredient->price : '100',[
                        'placeholder' => trans('admin.ingredient.price'),
                        'class' => 'form-control form-control-user'
                    ]); !!}
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    {!! Form::label('image', trans('admin.ingredient.image')); !!}
                    {!! Form::file('image', ['class' => 'form-control form-control-user']); !!}
                    <img src="{{isset($ingredient) ? $ingredient->image : ''}}" id="image-component" alt=""
                         class="upload-preview">
                </div>

                <div class="col-sm-6 mb-3 mb-sm-0">
                    {!! Form::label('pic', trans('admin.ingredient.pic')); !!}
                    {!! Form::file('pic', ['class' => 'form-control form-control-user']); !!}
                    <img src="{{isset($ingredient) ? $ingredient->pic : ''}}" id="pic-component" alt=""
                         class="upload-preview">
                </div>
            </div>
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
