<!-- Modal -->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header modal-backcolor">
                <h5 class="modal-title text-white" id="exampleModalLabel">Ввійти</h5>
                <a type="button" class="closebtn" id="closebtn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <form method="POST" action="{{ route('login') }}" class="modal-backcolor">

                <div class="modal-body">
                    @csrf

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right text-white">Телефон</label>

                        <div class="col-md-6">
                            <input id="phone" type="text"
                                   class="input-modal form-control @error('phone') is-invalid @enderror"
                                   name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right text-white">Пароль</label>

                        <div class="col-md-6">
                            <input id="password" type="password"
                                   class="input-modal form-control @error('password') is-invalid @enderror"
                                   name="password" required
                                   autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember"
                                       id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    Запам`ятати мене
                                </label>

                            </div>
                            {{--                              @if (Route::has('password.request'))
                                                              <a class="ml-3 text-white" href="{{ route('password.request') }}">
                                                                  Забули пароль?
                                                              </a>
                                                          @endif--}}
                        </div>
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <a type="submit" class="brand-color" data-toggle="modal" data-target="#register-modal"
                       data-dismiss="modal">
                        Створити аккаунт
                    </a>

                    <button type="submit" class="btn btn-yellow">
                        Ввійти
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@if($errors->any())
    <div class="alert alert-warning alert-dismissible fade show notification-error" role="alert" data-dismiss="alert"
         aria-label="Close">
        <strong>{{$errors->first()}}&nbsp;&nbsp;&nbsp;
            <button type="button" class="close" style="top: -4px;right: -15px">
                <span aria-hidden="true">&times;</span>
            </button>
        </strong>
    </div>
@endif


<!-- Modal -->
<div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="registerModal"
     aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header modal-backcolor">
                <h5 class="modal-title text-white" id="exampleModalLabel">Ввійти</h5>
                <a type="button" class="closebtn-register" id="closebtn-register" data-dismiss="modal"
                   aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <form method="POST" action="{{ route('register') }}" class="modal-backcolor">
                @csrf

                <div class="modal-body">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text"
                                   class="input-modal form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                        <div class="col-md-6">
                            <input id="phone" type="text"
                                   class="input-modal form-control @error('phone') is-invalid @enderror"
                                   name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password"
                                   class="input-modal form-control @error('password') is-invalid @enderror"
                                   name="password" required
                                   autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm"
                               class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="input-modal form-control"
                                   name="password_confirmation"
                                   required autocomplete="new-password">
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center mb-3">
                    <button type="submit" class="btn btn-yellow">
                        Зареєструватись
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
