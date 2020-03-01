@extends('admin.layouts.app')

@section('content')
    <!-- Page Heading -->

    @if(isset($category))
        {!! Form::open(['route' => ['admin::categories.update', $category->id], 'method' => 'PUT', 'files' => true]) !!}
    @else
        {!! Form::open(['route' => ['admin::categories.store'], 'method' => 'POST', 'files' => true]) !!}
    @endif
    {!! Form::token() !!}
    <div class="container row align-items-center justify-content-between mb-4">
        <h1 class="h5 text-gray-800">{{trans('admin.menu.categories')}}
            > @if(isset($category)){{trans('admin.actions.update')}}@else{{trans('admin.actions.create')}}@endif</h1>
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

                        <div class="col-sm-6 mb-3 mb-sm-0">
                            {!! Form::label('title', trans('admin.category.title')); !!}
                            {!! Form::text($locale.'[title]', isset($category) ? $category->translate($locale)->title : '',[
                                'placeholder' => trans('admin.category.title'),
                                'class' => 'form-control form-control-user'
                            ]); !!}
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    {!! Form::label('position', trans('admin.category.position')); !!}
                    {!! Form::number('position', isset($category) ? $category->position : '',[
                        'placeholder' => trans('admin.category.position'),
                        'class' => 'form-control form-control-user'
                    ]); !!}
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    {!! Form::label('parent_id', trans('admin.category.parent_category_id')); !!}
                    {!! Form::select('parent_id', $categories, isset($category) ? $category->parent_id : '',[
                        'class' => 'form-control form-control-user',
                        'placeholder' => ''
                    ]); !!}
                </div>

                <div class="col-sm-6 mb-3 mb-sm-0">
                    {!! Form::label('image', trans('admin.category.image')); !!}
                    {!! Form::file('image', ['class' => 'form-control form-control-user']); !!}
                </div>
                <img src="{{isset($category) ? $category->image : ''}}" id="upload" alt=""
                     class="upload-preview">
            </div>
        </div>
    </div>

    {!! Form::close() !!}

    @push('scripts')
        <script>
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#upload').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#image").change(function () {
                readURL(this);
            });
        </script>
    @endpush
@endsection