@extends('layouts.app')

@section('custom-title')
Admin Home
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
    <h1 class="display-6 fs-1 fw-bold mb-2"><span class="d-inline-block me-3">👋</span>Hi, {{Auth::user()->name}}!</h1>
    <div class="row">
        <div class="col-sm-6 col-lg-3 mb-2 mb-lg-2">
            <div class="card-body">
                <div class="row align-items-center text-center g-2">
                    <div class="col-6">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#addCanteen" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i>&nbsp;Canteen</button>
                    </div>
                    <div class="col-6">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#addCustomer" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i>&nbsp;Customer</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="addCanteen" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">New Canteen</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.canteen.store') }}">
                        @csrf
                        <div class="row g-2 mb-2">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Canteen Name">
                                        <label for="name" class="text-dark">Canteen Name</label>
                                        @error('name')
                                        <div class="invalid-feedback mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select @error('status') is-invalid @enderror" name="status" id="status" aria-label="">
                                        <option selected disabled>Select Status</option>
                                        <option value="active">Active</option>
                                        <option value="in active">In Active</option>
                                      </select>
                                      <label for="status" class="text-dark">Select Status</label>
                                    @error('status')
                                    <div class="invalid-feedback mt-2">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-success" value="Save">
                    </form>
                </div>
              </div>
            </div>
        </div>
        <div class="modal fade" id="addCustomer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Customer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('admin.customer.store') }}">
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
                            {{-- <div class="form-floating">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" autocomplete="new-password">
                                <label for="password-confirm" class="text-dark">Confirm Password</label>
                            </div><br> --}}
                            <div class="row g-3 mb-3">
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
                            </div>
                            <input type="submit" class="btn btn-success" value="Save">
                        </form>
                    </div>
                </div>
            </div>
        </div>
            
        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-3">
            <div class="card card-body shadow-sm border-primary">
                <h6 class="card-subtitle">Total Customers</h6>
                <div class="row align-items-center g-2">
                    <div class="col-8">
                        <h2 class="card-title text-inherit">0{{ count($customers) }}</h2>
                    </div>
                    <div class="col-4">
                        <h2 class="card-title fs-1 text-center"><i class="bi bi-people"></i></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-3">
            <div class="card card-body shadow-sm border-primary">
                <h6 class="card-subtitle">Total Canteen</h6>
                <div class="row align-items-center g-2">
                    <div class="col-8">
                        <h2 class="card-title text-inherit">0{{ count($canteens) }}</h2>
                    </div>
                    <div class="col-4">
                        <h2 class="card-title fs-1 text-center"><i class="bi bi-building"></i></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-3">
            <div class="card card-body shadow-sm border-primary">
                <h6 class="card-subtitle">Total Orders</h6>
                <div class="row align-items-center g-2">
                    <div class="col-8">
                        <h2 class="card-title text-inherit">0{{ count($orders) }}</h2>
                    </div>
                    <div class="col-4">
                        <h2 class="card-title fs-1 text-center"><i class="bi bi-check2-square"></i></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="canteen-tab" data-bs-toggle="tab" data-bs-target="#canteen" type="button" role="tab" aria-controls="canteen" aria-selected="true">Canteen</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="customer-tab" data-bs-toggle="tab" data-bs-target="#customer" type="button" role="tab" aria-controls="customer" aria-selected="false">Customer</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="order-tab" data-bs-toggle="tab" data-bs-target="#order" type="button" role="tab" aria-controls="order" aria-selected="false">Orders</button>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="canteen" role="tabpanel" aria-labelledby="canteen-tab">
            <h3 class="fs-4 mt-3 mb-3 fw-bold">Canteen Details</h3>
            <div class="card card-body table-responsive border-primary">
                <table id="canteenDetails" class="table table-sm table-striped" style="width:100%;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Created at</th>
                        <th>Canteen ID</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($canteens as $canteen)
                    <tr>
                        <td><a class="link" href="{{ route('admin.canteen.show', $canteen->id) }}">{{ $canteen->name }}</a></td>
                        <td>{{ Carbon\Carbon::parse($canteen->created_at)->diffForHumans() }}</td>
                        <td>{{ $canteen->id }}</td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane" id="customer" role="tabpanel" aria-labelledby="customer-tab">
            <h3 class="fs-4 mt-3 mb-3 fw-bold">Customer Details</h3>
            <div class="card card-body table-responsive border-primary">
                <table id="customerDetails" class="table table-sm table-striped" style="width:100%;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Signed Up</th>
                        <th>Customer ID</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                    <tr>
                        <td><a class="link" href="{{ route('admin.customer.show', $customer->id) }}">{{ $customer->name }}</a></td>
                        <td>{{ Carbon\Carbon::parse($customer->created_at)->diffForHumans() }}</td>
                        <td>{{ $customer->id }}</td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane" id="order" role="tabpanel" aria-labelledby="order-tab">
            <h3 class="fs-4 mt-3 mb-3 fw-bold">Order Details</h3>
            <div class="card card-body table-responsive border-primary">
                <table id="orderDetails" class="table table-sm table-striped" style="width:100%;">
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>Reference</th>
                        <th>Food Name</th>
                        <th>Order By</th>
                        {{-- <th>Contact No</th> --}}
                        <th>Customer Status</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>
                            {{ Carbon\Carbon::parse($order->created_at)->diffForHumans() }}
                        </td>
                        <td>
                            <a href="{{ route('admin.order.show', $order->id) }}">{{ $order->reference }}</a>
                        </td>
                        <td>{{ $order->name }}</td>
                        <td>
                            <a href="{{ route('admin.customer.show', $order->user->id) }}">{{ $order->user->name }}
                        </td>
                        {{-- <td>
                            @if($order->user->profile->contact == "")
                                Profile Not Available
                            @else
                                <a href="whatsapp:+91{{$order->user->profile->contact}}">{{ $order->user->profile->contact }}</a>
                            @endif
                        </td> --}}
                        <td>
                            @if($order->customer_status === 'ordered')
                                <span class="badge bg-primary text-capitalize">{{ $order->customer_status }}</span>
                            @endif
                            @if($order->customer_status === 'in-progress')
                                <span class="badge bg-info text-capitalize">{{ $order->customer_status }}</span>
                            @endif
                            @if($order->customer_status === 'on-the-way')
                                <span class="badge bg-warning text-capitalize">{{ $order->customer_status }}</span>
                            @endif
                            @if($order->customer_status === 'delivered')
                                <span class="badge bg-success text-capitalize">{{ $order->customer_status }}</span>
                            @endif
                            @if($order->customer_status === 'cancelled')
                                <span class="badge bg-danger text-capitalize">{{ $order->customer_status }}</span>
                            @endif
                        </td>
                        <td>
                            @if($order->status === 'received')
                                <span class="badge bg-primary text-capitalize">{{ $order->status }}</span>
                            @endif
                            @if($order->status === 'in-progress')
                                <span class="badge bg-info text-capitalize">{{ $order->status }}</span>
                            @endif
                            @if($order->status === 'on-the-way')
                                <span class="badge bg-warning text-capitalize">{{ $order->status }}</span>
                            @endif
                            @if($order->status === 'delivered')
                                <span class="badge bg-success text-capitalize">{{ $order->status }}</span>
                            @endif
                            @if($order->status === 'cancelled')
                                <span class="badge bg-danger text-capitalize">{{ $order->status }}</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-js')
<script>
$(document).ready(function(){
    $('.toast').toast('show');
    $('#customerDetails').DataTable();
    $('#canteenDetails').DataTable();
    $('#orderDetails').DataTable();
});
</script>
@endsection