@extends('layouts.customApp')

@section('custom-title')
Recover your Password!
@endsection

@section('content')
<div class="row">
    <div class="col-md-6 d-none d-md-block d-lg-block d-xl-block d-xxl-block">
        <img src="{{ asset('img/illustrations/welcome-banner.svg') }}" class="img-responsive img-fluid" alt="og:having_fun" height="500px" width="500px">
    </div>
    <div class="col-md-6">
        <form method="POST" action="{{ route('password.email') }}">
            <div class="text-center"><img class="mb-4 img-responsive img-fluid" src="{{ asset('img/logo.png') }}" alt="" width="100" height="100"></div>
            <h1 class="h2 mb-3 fw-normal text-center">Reset your Password!</h1>
            <h3 class="h6 mb-3 fw-normal text-center">Enter your email and we will send you a reset link</h3>
            @if(session('status'))
                <div class="alert alert-success d-flex alig-items-center alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-octagon-fill text-danger"></i>&nbsp;
                    <strong>Hey!</strong>&nbsp;{{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        @csrf
        <div class="form-floating">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Email Address" autocomplete="email">
            <label for="email" class="text-dark">Email address</label>
            @error('email')
            <div class="invalid-feedback mt-2">
                {{ $message }}
            </div>
            @enderror
        </div><br>
        <div class="text-center mb-3">
            <button class="w-50 btn btn-success rounded-pill text-white" type="submit">Send me the link</button>
        </div>
        </form>
    </div>
</div>
@endsection
