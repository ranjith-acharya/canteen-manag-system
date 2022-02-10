@extends('layouts.customApp')

@section('custom-title')
Create an Account!
@endsection

@section('content')
<div class="row">
    <div class="col-md-6 d-none d-md-block d-lg-block d-xl-block d-xxl-block">
        <img src="{{ asset('img/illustrations/welcome-banner.svg') }}" class="img-responsive img-fluid" alt="og:having_fun" height="500px" width="500px">
    </div>
    <div class="col-md-6">
        <form method="post" action="{{ route('register') }}">
            <div class="text-center"><img class="mb-4 img-responsive img-fluid" src="{{ asset('img/logo.png') }}" alt="" width="100" height="100"></div>
            <h1 class="h3 mb-3 fw-normal text-center">Create an Account!</h1>
            @csrf
            <div class="form-floating">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Full Name" autocomplete="name">
                <label for="name" class="text-dark">Full Name</label>
                @error('name')
                <div class="invalid-feedback mt-2">
                    {{ $message }}
                </div>
                @enderror
            </div><br>
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
            </div><br>
            <div class="form-floating">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" autocomplete="new-password">
                <label for="password-confirm" class="text-dark">Confirm Password</label>
            </div><br>
            <div class="row g-3">
                <div class="col-md-8">
                    <div class="form-floating">
                        <input type="text" class="form-control @error('card') is-invalid @enderror" name="card" id="card" placeholder="Card Number" maxlength="16" value="{{ old('card') }}">
                        <label for="card" class="text-dark">Card Number</label>
                        @error('card')
                        <div class="invalid-feedback mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="text" class="form-control @error('cardcvv') is-invalid @enderror" name="cardcvv" id="cardcvv" placeholder="CVV" maxlength="4">
                        <label for="cardcvv" class="text-dark">CVV</label>
                        @error('cardcvv')
                        <div class="invalid-feedback mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div><br>
            <div class="text-center mt-3 mb-3">
                <button class="w-50 btn btn-lg btn-success rounded-pill text-white" type="submit" data-bs-toggle="tooltip" data-bs-placement="bottom" title="By clicking on Sign up you agree to our College Terms and Conditions">Sign up</button>
            </div>
            <div class="text-center mb-5">
                <a class="link" href="{{ route('login') }}">
                    Already have an Account!
                </a>
            </div>
        </form>
    </div>
</div>  
@endsection

@section('custom-js')
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
@endsection