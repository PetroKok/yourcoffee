@extends('admin.layouts.app')

@section('content')
    <!-- Page Heading -->

    @if(isset($label))
        {!! Form::open(['route' => ['admin::label.update', $label->id], 'method' => 'PUT', 'files' => true]) !!}
    @else
        {!! Form::open(['route' => ['admin::label.store'], 'method' => 'POST', 'files' => true]) !!}
    @endif
    {!! Form::token() !!}
    <div class="container row align-items-center justify-content-between mb-4">
        <h1 class="h5 text-gray-800">{{trans('admin.menu.labels')}}
            > @if(isset($label)){{trans('admin.actions.update')}}@else{{trans('admin.actions.create')}}@endif</h1>
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
                            {!! Form::label('name', trans('admin.label.name')); !!}
                            {!! Form::text($locale.'[name]', isset($label) ? $label->translate($locale, true)->name : 'POMIDOR',[
                                'placeholder' => trans('admin.label.name'),
                                'class' => 'form-control form-control-user'
                            ]); !!}
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="form-group row">
                <div class="col mb-6 mb-sm-0">
                    {!! Form::label('position', trans('admin.label.position')); !!}
                    {!! Form::number('position', isset($label) ? $label->position : '0',[
                        'placeholder' => trans('admin.label.position'),
                        'class' => 'form-control form-control-user'
                    ]); !!}
                </div>
                <div class="col mb-6 mb-sm-0">
                    {!! Form::label('color', trans('admin.label.color')); !!}
                    {!! Form::text('color', isset($label) ? $label->color : '#',[
                        'placeholder' => trans('admin.label.position'),
                        'class' => 'form-control form-control-user'
                    ]); !!}
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
