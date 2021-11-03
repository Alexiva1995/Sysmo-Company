@extends('layouts/fullLayoutMaster')

@section('title', 'Login')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset('css/base/pages/page-auth.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom-login-register.css') }}">
@endsection

@section('content')
<x-guest-layout>
<div class="container row justify-content-center">
    <div class="col-12 order-2 order-md-1 col-md-4 offset-md-2 d-flex justify-content-center align-items-center">
        <div class="py-2">
            <div class="d-flex flex-column">
                <h2 class="text-dark font-weight-bold h1"><strong>¿Aún no eres parte?</strong></h2>
                <h3 class="text-dark font-weight-bold h2">Únete ahora</h3>
                <img src="{{ asset('assets/app-assets/images/pages/login/image-login.png') }}" alt="img">
            </div>
        </div>
    </div>
    <div class="col-12 order-md-2 col-md-6">
        <div class="py-2">
            <!-- Login v1 -->
            <div class="card mb-0">
                <div class="card-body">
                    <a href="javascript:void(0);" class="brand-logo">
                        <img src="{{asset('assets/app-assets/images/logo/logo-dark.png')}}" alt="">  
                    </a>
                    <h3 class="card-title text-center mt-2">Acceso de miembros</h3>

                    <x-jet-validation-errors class="mb-4" />

                    <form class="auth-login-form mt-2" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control @error('email') is-invalid @enderror"
                                id="login-email" name="email" placeholder="Correo"
                                aria-describedby="login-email" tabindex="1" autofocus value="{{ old('email') }}" />
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="input-group input-group-merge form-password-toggle">
                                <input type="password" class="form-control form-control-merge" id="login-password"
                                    name="password" tabindex="2"
                                    placeholder="Contraseña"
                                    aria-describedby="login-password" />
                                <div class="input-group-append">
                                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                </div>
                            </div>
                            @if (Route::has('password.request'))
                            <div class="font-weight-bold h4 pt-2 text-center">
                                <a href="{{ route('password.request') }}">¿Olvidó la Contraseña?</a>
                            </div>
                                
                            @endif
                        </div>
                                {{-- <label class="containercheck">
                                    <input class="" type="checkbox" id="remember-me" name="remember-me"
                                    tabindex="3" {{ old('remember-me') ? 'checked' : '' }} />
                                    <span class="checkmark"></span>
                                    <label class="recordar-datos" for="remember-me">Recordar Datos</label>
                                </label> --}}
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn text-center btnlogin" tabindex="4">Inicio de sesión</button>
                        </div>
                    </form>

                    <p class="text-center mt-1">
                        @if (Route::has('register'))
                        <a class="btn text-center btnregister" href="{{ route('register') }}">Registrate</a>
                        @endif
                    </p>

                </div>
            </div>
            <!-- /Login v1 -->
        </div>
    </div>
</div>
    
</x-guest-layout>
@endsection
