@extends('layouts.customApp')

@section('custom-title')
Login
@endsection

@section('content')
<div class="row">
    <div class="col-md-6 d-none d-md-block d-lg-block d-xl-block d-xxl-block">
        <img src="{{ asset('img/illustrations/welcome-banner.svg') }}" class="img-responsive img-fluid" alt="og:having_fun" height="500px" width="500px">
    </div>
    <div class="col-md-6">
        <form method="post" action="{{ route('login') }}">
            <div class="text-center"><img class="mb-4 img-responsive img-fluid" src="{{ asset('img/logo.png') }}" alt="" width="100" height="100"></div>
            <h1 class="h3 mb-3 fw-normal text-center">Sign in to your Account!</h1>
            @csrf
            <div class="form-floating">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email Address" value="{{ old('email') }}">
                <label for="email" class="text-dark">Email address</label>
                @error('email')
                <div class="invalid-feedback mt-2">
                    {{ $message }}
                </div>
                @enderror
            </div><br>
            <div class="form-floating">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
                <label for="password" class="text-dark">Password</label>
                @error('password')
                <div class="invalid-feedback mt-2">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="checkbox mb-3 mt-3">
                <div class="row d-flex container justify-content-between">
                    <div class="col-md-6">
                        <label>
                            <input type="checkbox" value="remember-me"> Remember me
                        </label>
                    </div>
                    <div class="col-md-6">
                    @if (Route::has('password.request'))
                        <a class="link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                    </div>
                </div>
            </div>
            <div class="text-center mb-3">
                <button class="w-50 btn btn-lg btn-success rounded-pill text-white" type="submit">Sign in</button>
            </div>
            <div class="text-center">
                <a class="link" href="{{ route('register') }}">
                    Create an Account!
                </a>
            </div>
        </form>
    </div>
</div>
@endsection