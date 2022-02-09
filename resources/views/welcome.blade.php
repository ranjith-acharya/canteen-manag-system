@extends('layouts.customApp')

@section('custom-title')
Welcome!
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="d-none d-lg-block"><br></div>
            <h3 class="display-2 mt-4">Welcome to Cafeteria!</h3>
            <h3 class="lead">For the happiest meals.</h3>
            <a class="link btn-link" href="{{ route('login') }}">
                <button class="btn btn-lg text-white btn-success border rounded-pill mt-2 shadow-sm ps-4 pe-4">
                    Get Started!
                </button>
            </a>
        </div>
        <div class="col-md-6">
            <img src="{{ asset('img/illustrations/welcome-banner.svg') }}" class="img-responsive img-fluid" alt="og:having_fun" height="500px" width="500px">
        </div>
    </div>
</div>
@endsection