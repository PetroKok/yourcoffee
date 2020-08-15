@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->

        <div id="table">

        </div>

    </div>
@endsection

@push('scripts')
    <script src="{{asset('admin_side/js/ReactTable.js', config('app.https'))}}"></script>
@endpush
