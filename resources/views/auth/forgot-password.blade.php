@extends('layouts/fullLayoutMaster')

@section('title', 'Forgot Password')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
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
                        <h3 class="card-title text-center mt-2">¿Olvidó la contraseña?</h3>
    
                        <x-jet-validation-errors class="mb-4" />
    
                        <form class="auth-forgot-password-form mt-2" action="{{ route('password.email') }}" method="POST">
                            @csrf
                            @if (session('status'))
                            <div class="mb-2 font-medium text-sm text-green-600">
                                {{ session('status') }}
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Correo" aria-describedby="email" tabindex="1" autofocus
                                    required :value="old('email')" />
                            </div>
                            <p class="text-muted mb-1">Proporcione su dirección de correo electrónico para reestablecer su contraseña</p>
                            <div class="d-flex justify-content-center">
                                <button class="btn text-center btnlogin" tabindex="2">
                                    Reestablecer contraseña
                                </button>
                            </div>
                        </form>
    
                        <p class="text-center mt-2">
                            <a href="{{ route('login') }}"> <i data-feather="chevron-left"></i> Volver para iniciar sesión
                            </a>
                        </p>
    
                    </div>
                </div>
                <!-- /Login v1 -->
            </div>
        </div>
    </div>
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
                    <p class="card-title">¿Has olvidado tu contraseña?</p>

                    <p class="card-text mb-2">Ingrese su correo electrónico y le enviaremos instrucciones para
                        restablecer su contraseña</p>

                    <x-jet-validation-errors class="mb-4" />

                    <form class="auth-forgot-password-form mt-2" action="{{ route('password.email') }}" method="POST">
                        @csrf
                        @if (session('status'))
                        <div class="mb-2 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Email@example.com" aria-describedby="email" tabindex="1" autofocus
                                required :value="old('email')" />
                        </div>
                        <button class="btn btn-warning btn-block border-radius-30" tabindex="2">Enviar enlace de
                            restablecimiento</button>
                    </form>

                    <p class="text-center mt-2">
                        <a class="creaunacuenta2" href="{{ route('login') }}"> <i data-feather="chevron-left"></i> Volver para iniciar sesión
                        </a>
                    </p>

                </div>
            </div>
            <!-- /Login v1 -->
        </div>
    </div>

    <div class="auth-wrapper auth-v1 px-2">
        <div class="auth-inner py-2">
            <!-- Forgot Password v1 -->
            <div class="card mb-0">
                <div class="card-body">
                    <a href="javascript:void(0);" class="brand-logo">
                        <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" height="28">
                            <defs>
                                <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%"
                                    y2="89.4879456%">
                                    <stop stop-color="#000000" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                </lineargradient>
                                <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%"
                                    y2="100%">
                                    <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                </lineargradient>
                            </defs>
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                    <g id="Group" transform="translate(400.000000, 178.000000)">
                                        <path class="text-primary" id="Path"
                                            d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z"
                                            style="fill: currentColor"></path>
                                        <path id="Path1"
                                            d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z"
                                            fill="url(#linearGradient-1)" opacity="0.2"></path>
                                        <polygon id="Path-2" fill="#000000" opacity="0.049999997"
                                            points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325">
                                        </polygon>
                                        <polygon id="Path-21" fill="#000000" opacity="0.099999994"
                                            points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338">
                                        </polygon>
                                        <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994"
                                            points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                    </g>
                                </g>
                            </g>
                        </svg>
                        <h2 class="brand-text text-primary ml-1">Sysmo Company</h2>
                    </a>

                    <h4 class="card-title mb-1">¿Has olvidado tu contraseña? 🔒</h4>
                    <p class="card-text mb-2">Ingrese su correo electrónico y le enviaremos instrucciones para
                        restablecer su contraseña</p>

                    <form class="auth-forgot-password-form mt-2" action="{{ route('password.email') }}" method="POST">
                        @csrf
                        @if (session('status'))
                        <div class="mb-2 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Email@example.com" aria-describedby="email" tabindex="1" autofocus
                                required :value="old('email')" />
                        </div>
                        <button class="btn btn-primary btn-block" tabindex="2">Enviar enlace de
                            restablecimiento</button>
                    </form>

                    <p class="text-center mt-2">
                        <a href="{{ route('login') }}"> <i data-feather="chevron-left"></i> Volver para iniciar sesión
                        </a>
                    </p>
                </div>
            </div>
            <!-- /Forgot Password v1 -->
        </div>
    </div>
</x-guest-layout>
@endsection
