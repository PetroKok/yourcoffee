@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-4 text-gray-800">{{trans('admin.menu.categories')}}</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i>
                {{trans('admin.actions.add_new')}}
            </a>
        </div>

        <div id="table">
        </div>

    </div>
@endsection

@push('scripts')
    <script src="{{asset('admin_side/js/ReactTable.js')}}"></script>
@endpush
