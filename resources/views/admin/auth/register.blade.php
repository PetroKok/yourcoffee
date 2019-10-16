@extends('admin.layouts.auth')

@section('content')
    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">{{trans('app.actions.registration')}}</h1>
                            </div>

                            <form method="POST" class="user" action="{{ route('admin::register') }}">
                                @csrf
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="{{trans('app.fields.name')}}">
                                    </div>
                                </div>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-group">
                                    <input
                                        type="email"
                                        name="email"
                                        class="form-control form-control-user"
                                        id="email"
                                        value="{{ old('email') }}"
                                        autocomplete="email"
                                        placeholder="{{trans('app.actions.enter_email')}}"
                                        required>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input
                                            type="password"
                                            class="form-control form-control-user"
                                            id="password"
                                            name="password"
                                            placeholder="{{trans('app.fields.password')}}"
                                            required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input
                                            type="password"
                                            class="form-control form-control-user"
                                            id="password_confirmation"
                                            name="password_confirmation"
                                            autocomplete="password_confirmation"
                                            placeholder="Repeat Password"
                                            required>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    {{ __('Register') }}
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="#">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="{{route('admin::login')}}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



@endsection
