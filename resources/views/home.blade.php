@extends('layouts.app')

@section('custom-title')
Home
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
    <h1 class="display-6 fs-1 fw-bold mb-3"><span class="d-inline-block me-3">👋</span>Hi, {{Auth::user()->name}}!</h1>
    <hr><div class="row">
        <h3 class="fs-4 mb-3 fw-bold">Choose Canteen</h3>
        @if(count($canteens) > 0)
            @foreach($canteens as $canteen)
            <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                <div class="card card-body shadow-sm border-primary">
                    <div class="row align-items-center g-2">
                        <div class="col-10">
                            <h4 class="h4 fs-5">{{ $canteen->name }}</h4>
                            @if($canteen->status == 'active')
                                <span class="badge bg-info fs-6">Open</span>
                            @else
                                <span class="badge bg-danger fs-6">Closed</span>
                            @endif
                        </div>
                        <div class="col-1">
                            <h2 class="fs-1 text-center">
                                <a href="@if($canteen->status == 'active') {{ route('canteen.show', $canteen->id) }} @else {{ route('home') }} @endif">
                                    <button class="btn btn-sm rounded-circle btn-primary"><i class="bi bi-arrow-right"></i></button>
                                </a>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
        <h1 class="h4 mb-3"><span class="badge bg-danger">No Canteen Available!</span></h1>
        @endif
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