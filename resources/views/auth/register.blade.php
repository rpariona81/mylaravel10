@extends('layouts.guest')

@section('content')
    <!-- Outer Row -->
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="{{ asset('assets/images/auth/register.jpg') }}" height="400" width="500">
                </div>
                <div class="col-lg-6">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">{{ __('Create an Account!') }}</h1>
                        </div>
                        <form class="user" action="{{ route('register') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <input type="text" name="name"
                                    class="form-control form-control-user @error('name') is-invalid @enderror"
                                    id="exampleInputName" placeholder="{{ __('Name') }}" required>
                            </div>
                            @error('name')
                                <div class="form-group custom-control">
                                    <label class="">{{ $message }}</label>
                                </div>
                            @enderror

                            <div class="form-group">
                                <input type="email" name="email"
                                    class="form-control form-control-user @error('email') is-invalid @enderror"
                                    id="exampleInputEmail" placeholder="{{ __('Email Address') }}" required>
                            </div>
                            @error('email')
                                <div class="form-group custom-control">
                                    <label class="">{{ $message }}</label>
                                </div>
                            @enderror

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" name="password"
                                        class="form-control form-control-user @error('password') is-invalid @enderror"
                                        id="exampleInputPassword" placeholder="{{ __('Password') }}" required>
                                </div>
                                @error('password')
                                    <div class="form-group custom-control">
                                        <label class="">{{ $message }}</label>
                                    </div>
                                @enderror

                                <div class="col-sm-6">
                                    <input type="password" name="password_confirmation"
                                        class="form-control form-control-user @error('password_confirmation') is-invalid @enderror"
                                        id="exampleRepeatPassword" placeholder="{{ __('Repeat Password') }}">
                                </div>
                                @error('password_confirmation')
                                    <div class="form-group custom-control">
                                        <label class="">{{ $message }}</label>
                                    </div>
                                @enderror

                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <button type="submit" class="btn btn-dark btn-user btn-block">
                                        {{ __('Register Account') }}
                                    </button>
                                </div>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <a class="btn btn-warning btn-block"
                                        href="{{ route('home') }}">{{ __('Volver!') }}</a>
                                </div>
                            </div>
                        </form>
                        <hr>
                        @if (Route::has('password.request'))
                            <div class="text-center">
                                <a class="small" href="{{ route('password.request') }}">{{ __('Forgot Password?') }}</a>
                            </div>
                        @endif
                        @if (Route::has('login'))
                            <div class="text-center">
                                <a class="small"
                                    href="{{ route('login') }}">{{ __('Already have an account? Login!') }}</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
