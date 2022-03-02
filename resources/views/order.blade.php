@extends('layouts.app')

@section('custom-title')
Order Details
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
    <h4 class="display-6 fs-1 mb-2">Order Details 🍴
        @if(Auth::user()->role === 'customer')
            @if($order->customer_status === 'ordered')
                <span class="badge bg-primary text-capitalize fs-5">{{ $order->customer_status }}</span>
            @endif
            @if($order->customer_status === 'in-progress')
                <span class="badge bg-info text-capitalize fs-5">{{ $order->customer_status }}</span>
            @endif
            @if($order->customer_status === 'on-the-way')
                <span class="badge bg-warning text-capitalize fs-5">{{ $order->customer_status }}</span>
            @endif
            @if($order->customer_status === 'delivered')
                <span class="badge bg-success text-capitalize fs-5">{{ $order->customer_status }}</span>
            @endif
            @if($order->customer_status === 'cancelled')
                <span class="badge bg-danger text-capitalize fs-5">{{ $order->customer_status }}</span>
            @endif
        @else
            @if($order->status === 'received')
                <span class="badge bg-primary text-capitalize fs-5 mb-2">{{ $order->status }}</span>
            @endif
            @if($order->status === 'in-progress')
                <span class="badge bg-info text-capitalize fs-5 mb-2">{{ $order->status }}</span>
            @endif
            @if($order->status === 'on-the-way')
                <span class="badge bg-warning text-capitalize fs-5 mb-2">{{ $order->status }}</span>
            @endif
            @if($order->status === 'delivered')
                <span class="badge bg-success text-capitalize fs-5 mb-2">{{ $order->status }}</span>
            @endif
            @if($order->status === 'cancelled')
                <span class="badge bg-danger text-capitalize fs-5 mb-2">{{ $order->status }}</span>
            @endif
        @endif
    </h4>
    @if(Auth::user()->role === 'admin')
    <form method="post" action="{{ route('admin.set.order.status') }}">
    @csrf
    <input type="hidden" name="order_id" value="{{ $order->id }}">
    <div class="row g-3">
        <div class="col-md-4">
            <div class="form-floating">
                <select class="form-select @error('status') is-invalid @enderror" name="status" id="status">
                    <option selected disabled>Select Status</option>
                    <option value="received" @if($order->status == 'received') selected @endif>Received</option>
                    <option value="in-progress" @if($order->status == 'in-progress') selected @endif>In-Progress</option>
                    <option value="on-the-way" @if($order->status == 'on-the-way') selected @endif>On-the-way</option>
                    <option value="delivered" @if($order->status == 'delivered') selected @endif>Delivered</option>
                    <option value="cancelled" @if($order->status == 'cancelled') selected @endif>Cancelled</option>
                </select>
                <label for="status" class="text-dark">Select Status</label>
                @error('status')
                <div class="invalid-feedback mt-2">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <input type="submit" class="btn btn-sm btn-success mt-1" value="Update Status">
        </div>
    </div>
    </form>
    @endif

    <hr>
    <div class="container col-md-8">
        <div class="card shadow-sm">
            <img src="{{ asset('img/illustrations/wavesOpacity.svg') }}">
            <div class="mx-auto mb-1">
                <img src="{{ asset('img/logo.png') }}" width="64px" height="64px" class="img-fluid">
            </div>
            <div class="mx-auto mb-2 mt-1 lead"><ins>{{ $order->canteen->name }}&nbsp;Canteen</ins></div>
            <div class="table-responsive col-md-8 container">
                <p class="mt-1 mb-2">
                    <strong>Order</strong> <ins>{{ $order->reference }}</ins>
                    <span class="float-end">{{ Carbon\Carbon::parse($order->created_at)->format('d-M-Y') }}</span>
                </p>
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>Food Item</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->count }} * {{ $order->price }}</td>
                        </tr>
                        <tr>
                            <td><hr></td>
                            <td><hr></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Total</td>
                            <td>{{ $order->total }}/-</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <hr>
            <div class="container mb-3">
                <div class="float-end">Billed to: <span class="fst-italic">{{ $order->user->name }}</span></div>
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