@extends('admin.layouts.app')

@section('content')
    <!-- Page Heading -->

    @if(isset($city))
        {!! Form::open(['route' => ['admin::cities.update', $city->id], 'method' => 'PUT', 'files' => true]) !!}
    @else
        {!! Form::open(['route' => ['admin::cities.store'], 'method' => 'POST', 'files' => true]) !!}
    @endif
    {!! Form::token() !!}
    <div class="container row align-items-center justify-content-between mb-4">
        <h1 class="h5 text-gray-800">{{trans('admin.menu.cities')}}
            > @if(isset($city)){{trans('admin.actions.update')}}@else{{trans('admin.actions.create')}}@endif</h1>
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
                            {!! Form::label('name', trans('admin.city.name')); !!}
                            {!! Form::text($locale.'[name]', isset($city) ? $city->translate($locale, true)->name : '',[
                                'placeholder' => trans('admin.city.name'),
                                'class' => 'form-control form-control-user'
                            ]); !!}
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    {!! Form::close() !!}

@endsection
