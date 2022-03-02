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
            <div class="col-sm-6 col-lg-3 mb-3 mb-lg-3">
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

    <div class="accordion bg-white" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button bg-white fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Recent Orders (Week)
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="row g-2 mb-4">
                        @if(count($orders) > 0)
                            @foreach($orders as $order)
                            <div class="col-12 col-md-4">
                                <div class="border bg-white">
                                    <div class="row p-3">
                                        <div class="col-7">
                                            <a href="{{ route('order.show', $order->id) }}"><h5 class="mb-2 fs-3">{{ $order->name }}</h5></a>
                                            <h5 class="mb-2 fs-6">{{ $order->canteen->name }}&nbsp;Canteen</h5>
                                            <p class="mb-0">
                                                @if($order->customer_status === 'ordered')
                                                    <span class="badge bg-primary text-capitalize fs-6">{{ $order->customer_status }}</span>
                                                @endif
                                                @if($order->customer_status === 'in-progress')
                                                    <span class="badge bg-info text-capitalize fs-6">{{ $order->customer_status }}</span>
                                                @endif
                                                @if($order->customer_status === 'on-the-way')
                                                    <span class="badge bg-warning text-capitalize fs-6">{{ $order->customer_status }}</span>
                                                @endif
                                                @if($order->customer_status === 'delivered')
                                                    <span class="badge bg-success text-capitalize fs-6">{{ $order->customer_status }}</span>
                                                @endif
                                                @if($order->customer_status === 'cancelled')
                                                    <span class="badge bg-danger text-capitalize fs-6">{{ $order->customer_status }}</span>
                                                @endif
                                            </p>
                                            <p class="mb-0 mt-2">
                                                {{ Carbon\Carbon::parse($order->created_at)->diffForHumans() }}
                                            </p>
                                        </div>
                                        <div class="col-5">
                                            <div class="fs-4 text-black float-end">
                                            ₹{{ $order->price }}
                                            </div>
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
            </div>
            </div>
            <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button bg-white fs-4 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Recent Orders (Month)
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="row g-2 mb-4">
                        @if(count($orderAll) > 0)
                            @foreach($orderAll as $orders)
                            <div class="col-12 col-md-4">
                                <div class="border bg-white">
                                    <div class="row p-3">
                                        <div class="col-7">
                                            <a href="{{ route('order.show', $orders->id) }}"><h5 class="mb-2 fs-3">{{ $orders->name }}</h5></a>
                                            <h5 class="mb-2 fs-6">{{ $orders->canteen->name }}&nbsp;Canteen</h5>
                                            <p class="mb-0">
                                                @if($orders->customer_status === 'ordered')
                                                    <span class="badge bg-primary text-capitalize fs-6">{{ $orders->customer_status }}</span>
                                                @endif
                                                @if($orders->customer_status === 'in-progress')
                                                    <span class="badge bg-info text-capitalize fs-6">{{ $orders->customer_status }}</span>
                                                @endif
                                                @if($orders->customer_status === 'on-the-way')
                                                    <span class="badge bg-warning text-capitalize fs-6">{{ $orders->customer_status }}</span>
                                                @endif
                                                @if($orders->customer_status === 'delivered')
                                                    <span class="badge bg-success text-capitalize fs-6">{{ $orders->customer_status }}</span>
                                                @endif
                                                @if($orders->customer_status === 'cancelled')
                                                    <span class="badge bg-danger text-capitalize fs-6">{{ $orders->customer_status }}</span>
                                                @endif
                                            </p>
                                            <p class="mb-0 mt-2">
                                                {{ Carbon\Carbon::parse($orders->created_at)->diffForHumans() }}
                                            </p>
                                        </div>
                                        <div class="col-5">
                                            <div class="fs-4 text-black float-end">
                                            ₹{{ $orders->price }}
                                            </div>
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