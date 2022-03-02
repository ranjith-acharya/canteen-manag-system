@extends('layouts.customApp')

@section('custom-title')
Reset your Password
@endsection

@section('content')
<div class="row">
    <div class="col-md-6 d-none d-md-block d-lg-block d-xl-block d-xxl-block">
        <img src="{{ asset('img/illustrations/welcome-banner.svg') }}" class="img-responsive img-fluid" alt="og:having_fun" height="500px" width="500px">
    </div>
    <div class="col-md-6">
        <form method="POST" action="{{ route('password.update') }}">
            <div class="text-center"><img class="mb-4 img-responsive img-fluid" src="{{ asset('img/logo.png') }}" alt="" width="100" height="100"></div>
            <h1 class="h3 mb-3 fw-normal text-center">Reset your Password!</h1>
            @csrf        
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-floating">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email Address" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                <label for="email" class="text-dark">Email address</label>
                @error('email')
                <div class="invalid-feedback mt-2">
                    {{ $message }}
                </div>
                @enderror
            </div><br>
            <div class="form-floating">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password"  required autocomplete="new-password">
                <label for="password" class="text-dark">Password</label>
                @error('password')
                <div class="invalid-feedback mt-2">
                    {{ $message }}
                </div>
                @enderror
            </div><br>
            <div class="form-floating">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" autocomplete="new-password">
                <label for="password-confirm" class="text-dark">Confirm Password</label>
            </div><br>      
            <div class="text-center mt-3 mb-3">
                <button class="w-50 btn btn-lg btn-success rounded-pill text-white" type="submit">Reset Password</button>
            </div>
        </form>
    </div>
</div>
@endsection
