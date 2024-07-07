@extends('layouts.app-auth')

@section('login-content')

@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
{{-- <form class="form-horizontal form-material text-center" id="loginform" action="index.html"> --}}
    <form class="form-horizontal form-material text-center" id="loginform"  method="POST" action="{{ route('login') }}" >
        @csrf
    {{-- <a href="javascript:void(0)" class="db"><img src="{{ asset('assets/images/logo-icon.png')  }}" alt="Home" /><br/><img src="{{ asset('assets/images/logo-text.png') }}" alt="Home" /></a> --}}
    <h3>ACCESO AL SISTEMA</h3>
    <div class="form-group m-t-40">
        <div class="col-xs-12">
            {{-- <input class="form-control" type="text" required="" placeholder="Username"> --}}
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Correo electronico">
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-12">
            {{-- <input class="form-control" type="password" required="" placeholder="Password"> --}}
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
   
    <div class="form-group row">
        <div class="col-md-12">
            <div class="d-flex no-block align-items-center">
               <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="showPass">
                <label class="form-check-label" for="showPass">
                    Mostrar contraseña
                </label>
            </div>
            </div>
        </div>
    </div>
    <div class="form-group text-center m-t-20">
        <div class="col-xs-12">
            <button   class="btn btn-info btn-lg btn-block text-uppercase btn-rounded" type="submit">ENTRAR</button>
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
            <div class="social">
                <button class="btn  btn-facebook" data-toggle="tooltip" title="Login with Facebook"> <i aria-hidden="true" class="fab fa-facebook-f"></i> </button>
                <button class="btn btn-googleplus" data-toggle="tooltip" title="Login with Google"> <i aria-hidden="true" class="fab fa-google-plus-g"></i> </button>
            </div>
        </div>
    </div> --}}
    <div class="form-group m-b-0">
        <div class="col-sm-12 text-center">
            {{-- ¿No tienes una cuenta?<a href="{{ route('register') }}" class="text-primary m-l-5"><b>Registrate</b></a> --}}
        </div>
    </div>
</form>
<form class="form-horizontal" id="recoverform" action="index.html">
    <div class="form-group ">
        <div class="col-xs-12">
            <h3>Recover Password</h3>
            <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
        </div>
    </div>
    <div class="form-group ">
        <div class="col-xs-12">
            <input class="form-control" type="text" required="" placeholder="Email">
        </div>
    </div>
    <div class="form-group text-center m-t-20">
        <div class="col-xs-12">
            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
        </div>
    </div>
</form>

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@stop
