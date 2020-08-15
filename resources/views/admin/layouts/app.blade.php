<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Your Burger</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{asset('admin_side/vendor/fontawesome-free/css/all.min.css', config('app.https'))}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Styles -->
    <link href="{{asset('admin_side/css/sb-admin-2.min.css', config('app.https'))}}" rel="stylesheet">
    <link href="{{asset('admin_side/css/custom.css', config('app.https'))}}" rel="stylesheet">

    <!--  CUSTOM CSS -->
    @stack('styles')

</head>

<body id="page-top">


<!-- Page Wrapper -->
<div id="wrapper">

@include('admin.common.sidebar')

<!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

        @include('admin.common.topbar')

        <!-- Begin Page Content -->
        @yield('content')
        <!-- /.container-fluid -->
            <div class="mt-5 pb-5"></div>
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2019</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

@stack('modals')

@include('admin.common.logout_modal')

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

</body>

<!-- Bootstrap core JavaScript-->
<script src="{{asset('/admin_side/vendor/jquery/jquery.min.js', config('app.https'))}}"></script>
<script src="{{asset('/admin_side/vendor/bootstrap/js/bootstrap.bundle.min.js', config('app.https'))}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('/admin_side/vendor/jquery-easing/jquery.easing.min.js', config('app.https'))}}"></script>

<!-- Custom scripts for all pages-->
{{--<script src="{{asset('js/all.js')}}"></script>--}}
<script src="{{asset('/admin_side/js/sb-admin-2.min.js', config('app.https'))}}"></script>
<script src="{{asset('/admin_side/js/custom.js', config('app.https'))}}"></script>
{{--<script src="{{asset('/enable-push.js')}}"></script>--}}
<!--  CUSTOM JS -->
@stack('scripts')
</html>
