@extends('layouts/fullLayoutMaster')

@section('title', 'Register')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset('css/base/pages/page-auth.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom-login-register.css') }}">
@endsection

@php $referred = null; @endphp
@if ( request()->referred_id != null )
    @php
        $referred = DB::table('users')
            ->select('username','id')
            ->where('id', '=', request()->referred_id)
            ->first();
    @endphp
@endif

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
                        <h3 class="card-title text-center mt-2">Regístrate y empieza a aprender</h3>
    
                        <x-jet-validation-errors class="mb-4" />
    
                        <form class="auth-register-form mt-2" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-6">
                                    <input type="text" class="form-control @error('firstname') is-invalid @enderror"
                                        id="register-firstname" name="firstname" placeholder="Nombre"
                                        aria-describedby="register-firstname" tabindex="1" autofocus
                                        value="{{ old('firstname') }}" required />
                                    @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <input type="text" class="form-control @error('lastname') is-invalid @enderror"
                                        id="register-lastname" name="lastname" placeholder="Apellido"
                                        aria-describedby="register-lastname" tabindex="1" autofocus
                                        value="{{ old('lastname') }}" required />
                                    @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-12 mb-0">
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        id="register-username" name="username" placeholder="Nombre de usuario"
                                        aria-describedby="register-username" tabindex="1" autofocus
                                        value="{{ old('username') }}" required />
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    @if ($referred != null)
                                    <input type="hidden" class="form-control @error('referred_id') is-invalid @enderror"
                                    id="register-referred_id" name="referred_id" placeholder="{{ $referred->username }}"
                                    aria-describedby="register-referred_id" tabindex="1" autofocus
                                    value="{{ $referred->id }}" readonly/>
    
                                    @else
    
                                    <input type="hidden" class="form-control @error('referred_id') is-invalid @enderror"
                                    id="register-referred_id" name="referred_id" placeholder="Sin referido"
                                    aria-describedby="register-referred_id" tabindex="1" autofocus
                                    value="1" readonly/>
                                    @endif
                                    @error('referred_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="register-email" name="email" placeholder="Correo"
                                        aria-describedby="register-email" tabindex="2" value="{{ old('email') }}" required />
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
    
                                <div class="form-group col-12">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="register-email" name="email" placeholder="Confirma Correo"
                                        aria-describedby="register-email" tabindex="2" value="{{ old('email') }}" required />
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
    
                                <div class="form-group col-6">
    
                                    <div
                                        class="input-group input-group-merge form-password-toggle @error('password') is-invalid @enderror">
                                        <input type="password"
                                            class="form-control form-control-merge @error('password') is-invalid @enderror"
                                            id="register-password" name="password"
                                            placeholder="Contraseña"
                                            aria-describedby="register-password" tabindex="3" required />
                                        <div class="input-group-append">
                                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                        </div>
                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
    
                                <div class="form-group col-6">
    
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input type="password" class="form-control form-control-merge"
                                            id="register-password-confirm" name="password_confirmation"
                                            placeholder="Confirma Contraseña"
                                            aria-describedby="register-password" tabindex="3" required
                                            autocomplete="new-password" />
                                        <div class="input-group-append">
                                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                        </div>
                                    </div>
                                </div>
    
                                {{-- <div class="form-group col-12 ml-1">
                                    <label class="containercheck">
                                        <input class="" type="checkbox" id="register-privacy-policy"
                                        tabindex="3" required {{ old('remember-me') ? 'checked' : '' }} />
                                        <span class="checkmark"></span>
                                        <label class="recordar-datos" for="register-privacy-policy">
                                            Acepto las <a href="#terms" class="text-info">política y condiciones de
                                                privacidad</a></label>
                                    </label>
                                    
    
                                </div> --}}
                                <button type="submit" class="btn text-center btnlogin" tabindex="5">Regístrate</button>
                            </div>
                        </form>
    
                            @if (Route::has('login'))
                            <div class="font-weight-bold h4 pt-2 text-center">
                                <a href="{{ route('login') }}">¿Ya tienes una cuenta? Inicio de sesión</a>
                            </div>
                            
                            @endif
    
                    </div>
                </div>
                <!-- /Login v1 -->
            </div>
        </div>
    </div>
</x-guest-layout>
@endsection
