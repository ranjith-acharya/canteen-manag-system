@extends('layouts.app')

@section('custom-title')
Customer Details
@endsection

@section('content')
@if(session('status'))
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div class="toast" role="status" aria-live="polite" data-bs-autohide="true" data-bs-animation="true" data-bs-delay="10000">
        <div class="toast-header">
            <img src="{{ asset('img/logo.ico') }}" class="rounded img-fluid me-2" alt="logo" height="30" width="30">
            <strong class="me-auto">Cafeteria</strong>
            <small>{{ date('s') }}&nbsp;secs ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body text-success">
            <i class="bi bi-check2-circle text-success"></i>&nbsp;&nbsp;{{ session('status') }}
        </div>
    </div>
</div>
@endif
<div class="container">
    <h4 class="display-6 mt-2">Profile <i class="bi bi-sliders2"></i></h4>
    <div class="card card-body mt-4">
        <div class="row">
            <div class="col-md-3 text-center">
                <img src="../../img/user/{{ $customer->avatar }}" class="img-fluid" height="128px" width="128px">
            </div>
            <div class="col-md-9">
                <div class="row g-2 mb-2">
                    <div class="form-group col-md-4">
                        <label for="name" class="fw-bold">Full name :</label>
                        <div class="">{{ $customer->name }}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email_address" class="fw-bold">Email address :</label>
                        <div class=""><a href="mailto:{{ $customer->email }}" class="link">{{ $customer->email }}</a></div>
                    </div>
                </div>
                <div class="row g-2 mb-2">
                    <div class="form-group col-md-4">
                        <label for="account_created" class="fw-bold">Account created :</label>
                        <div class="">{{ \Carbon\Carbon::parse($customer->created_at)->diffForHumans() }}</div>
                    </div>
                </div>
                @if(count($profile) > 0)
                <div class="row g-2 mb-2">
                    <div class="form-group col-md-4">
                        <label for="department" class="fw-bold">Department :</label>
                        <div class="text-capitalize">{{ $customer->profile->department }}&nbsp;{{ $customer->profile->branch }}</div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="year" class="fw-bold">Year :</label>
                        <div class="text-capitalize">{{ $customer->profile->year }}</div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="contact" class="fw-bold">Contact :</label>
                        <div class="text-capitalize"><a href="whatsapp:+91{{ $customer->profile->contact }}" class="link">+91&nbsp;{{ $customer->profile->contact }}</a></div>
                    </div>
                </div>
                @else
                    <h1 class="h4"><span class="badge bg-info">Profile Information Not Available!</span></h1>
                @endif
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