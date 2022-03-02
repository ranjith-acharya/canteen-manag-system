@extends('layouts.customApp')

@section('custom-title')
Verify your Email Address
@endsection

@section('content')
@if(session('resent'))
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div class="toast" role="status" aria-live="polite" data-bs-autohide="true" data-bs-animation="true" data-bs-delay="10000">
        <div class="toast-header">
            <img src="{{ asset('img/logo.ico') }}" class="rounded img-fluid me-2" alt="logo" height="30" width="30">
            <strong class="me-auto">Cafeteria</strong>
            <small>{{ date('s') }}&nbsp;secs ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body text-success">
            <i class="bi bi-check2-circle text-success"></i>&nbsp;&nbsp;A fresh verification link has been sent to your email address.
        </div>
    </div>
</div>
@endif
<div class="container">
    <div class="mt-5">
        <div class="row justify-content-center card-body">
            <div class="col-md-6 text-center lead">
                {{ __('Before proceeding, please check your email for a verification link.') }}
                {{ __('If you did not receive the email') }},
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline fw-bold">{{ __('click here to request another') }}</button>.
                </form>
                <div class="mt-4">
                    <img src="{{ asset('img/illustrations/verify-banner.svg') }}" width="250px" height="250px" class="img-fluid img-responsive">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-js')
<script>
    $(document).ready(function(){
        $('.toast').toast('show');
    });
</script>
@endsection