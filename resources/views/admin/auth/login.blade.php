@extends('admin.layouts.auth')

@section('content')

    {{--    @dd($errors)--}}

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">{{trans('app.actions.welcome_back')}}</h1>
                                    </div>

                                    <form class="user" method="POST" action="{{ route('admin::login') }}">
                                        @csrf
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" name="email"
                                                   id="email" placeholder="{{trans('app.actions.enter_email')}}">
                                        </div>

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="form-group">
                                            <input type="password" name="password"
                                                   class="form-control form-control-user"
                                                   placeholder="{{trans('app.fields.password')}}">
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" name="remember"
                                                       id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label"
                                                       for="customCheck">{{trans('app.actions.remember_me')}}</label>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            {{trans('app.fields.login')}}
                                        </button>

                                    </form>


                                    <hr>
                                    <div class="text-center">
                                        <a class="small"
                                           href="forgot-password.html">{{trans('app.actions.forgot_password')}}</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{route('admin::register')}}">{{trans('app.actions.create_account')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('admin_side/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admin_side/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('admin_side/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('admin_side/js/sb-admin-2.min.js')}}"></script>
@endsection
