@extends('layouts/fullLayoutMaster')

@section('title', 'Login')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset('css/base/pages/page-auth.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom-login-register.css') }}">
@endsection

@section('content')
<x-guest-layout>

    <div class="bg-login-register"></div>
    <div class="auth-wrapper auth-v1 px-2">
        <div class="auth-inner py-2">
            <!-- Login v1 -->
            <div class="card mb-0">
                <div class="card-body">
                    <a href="javascript:void(0);" class="brand-logo">
                        <svg width="188" height="90" viewBox="0 0 188 90" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <rect width="188" height="90" fill="url(#pattern0)"/>
                            <defs>
                            <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                            <use xlink:href="#image0" transform="translate(0 -0.00288066) scale(0.00617284 0.0128944)"/>
                            </pattern>
                            <image id="image0" width="162" height="78" xlink:href="data:image/png;base64,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"/>
                            </defs>
                        </svg>
                            
                    </a>

                    {{-- <h4 class="card-title mb-1">Bienvenido a Sysmo Company! 👋</h4> --}}
                    <p class="card-title">Iniciar Sesión</p>

                    {{-- <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis sunt iusto deserunt ad aspernatur.</p> --}}

                    <x-jet-validation-errors class="mb-4" />

                    <form class="auth-login-form mt-2" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="login-email" class="form-label">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror"
                                id="login-email" name="email" placeholder="Email@example.com"
                                aria-describedby="login-email" tabindex="1" autofocus value="{{ old('email') }}" />
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="d-flex justify-content-between">
                                <label for="login-password" class="form-label">Contraseña</label>
                                @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">
                                    <small>Olvidaste la Contraseña?</small>
                                </a>
                                @endif
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input type="password" class="form-control form-control-merge" id="login-password"
                                    name="password" tabindex="2"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="login-password" />
                                <div class="input-group-append">
                                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                </div>
                            </div>
                        </div>
                                <label class="containercheck">
                                    <input class="" type="checkbox" id="remember-me" name="remember-me"
                                    tabindex="3" {{ old('remember-me') ? 'checked' : '' }} />
                                    <span class="checkmark"></span>
                                    <label class="recordar-datos" for="remember-me">Recordar Datos</label>
                                </label>
                        <button type="submit" class="btn btn-primary btn-block" tabindex="4">Entrar</button>
                    </form>

                    <p class="text-center mt-2">
                        <span class="creaunacuenta">¿Aún no tienes cuenta?</span>
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}">
                            <span class="text-primary creaunacuenta2">Registrate</span>
                        </a>
                        @endif
                    </p>

                </div>
            </div>
            <!-- /Login v1 -->
        </div>
    </div>
</x-guest-layout>
@endsection
