@extends('admin.layouts.app')

@section('content')
    <!-- Page Heading -->

    <div class="container-fluid mb-4">


        <div class="d-flex align-items-center justify-content-between">
            <h1 class="h5 text-gray-800">{{trans('admin.menu.ingredients')}} > {{trans('admin.actions.show')}}</h1>
            <a type="submit" href="{{url()->previous()}}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-backward fa-sm text-white-50"></i>
                {{trans('admin.actions.back')}}
            </a>
        </div>

        <div class="row">
            <div class="col-sm-6 row mb-sm-0">
                <img src="{{$ingredient->image}}" id="upload" alt="" class="upload-preview">
            </div>

            <div class="col-sm-6 pt-5 mb-sm-0">
                <b>{!! Form::label('name', trans('admin.ingredient.name')); !!}:</b>
                <span>{{$ingredient->name}}</span>
                <br>

                <b>{!! Form::label('description', trans('admin.ingredient.description')); !!}:</b>
                <span>{{$ingredient->description}}</span>
                <br>

                <b>{!! Form::label('parent_ingredient_id', trans('admin.ingredient.parent_ingredient_id')); !!}:</b>
                <span>{{$ingredient->parent_ingredient_id === null ? trans('admin.actions.null') : $ingredient->ingredient->title}}</span>

            </div>
        </div>
    </div>
@endsection
