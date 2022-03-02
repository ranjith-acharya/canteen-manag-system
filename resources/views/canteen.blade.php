@extends('layouts.app')

@section('custom-title')
Canteen Details
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
    <h4 class="display-6 fs-1 mb-2">{{ $canteen->name }}&nbsp;Canteen</h4>
    @if($canteen->status == 'active')
        <span class="badge bg-info fs-6 mb-3">Open</span>
    @else
        <span class="badge bg-danger fs-6 mb-3">Closed</span>
    @endif
    <div class="row">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="veg-tab" data-bs-toggle="tab" data-bs-target="#veg" type="button" role="tab" aria-controls="veg" aria-selected="true">Veg Food</button>
            </li>
            {{-- <li class="nav-item" role="presentation">
                <button class="nav-link" id="non-veg-tab" data-bs-toggle="tab" data-bs-target="#nonveg" type="button" role="tab" aria-controls="non-veg" aria-selected="false">Non-Veg</button>
            </li> --}}
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="veg" role="tabpanel" aria-labelledby="veg-tab">
                <h3 class="fs-4 mt-3 mb-3 fw-bold">Veg Food!</h3>
                @if(count($foodItemsVeg) > 0)
                <div class="row">    
                    @foreach($foodItemsVeg as $veg)
                    <div class="col-12 col-md-6 gy-4">
                        <div class="py-3 border bg-white">
                          <div class="row">
                            <div class="col-3 align-self-center">
                              <div class="ratio ratio-1x1">
                                <img class="img-fluid ms-2" src="../../img/food/{{ $veg->image }}" alt="...">
                              </div>
                            </div>
                            <div class="col-7">
                              <h5 class="mb-2 fs-3">{{ $veg->name }}</h5>
                              <p class="mb-3">
                                {{ Str::mask($veg->description, '.', '140') }}
                              </p>
                                <input type="hidden" value="{{ $veg->id }}">
                                <input type="hidden" value="{{ $veg->name }}">
                                <input type="hidden" value="{{ $veg->price }}">
                              <button class="btn btn-sm btn-success mt-1" data-bs-toggle="modal" data-bs-target="#placeOrderVeg" onclick="placeOrderBtnVeg(this)">Place Order</button>
                            </div>
                            <div class="col-2">
                              <div class="fs-4 font-serif text-center text-black">
                                ₹{{ $veg->price }}
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="modal fade" id="placeOrderVeg" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Place Order</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" id="placeOrderItemsVeg">
                                        <form method="post" action="{{ route('order.store') }}">
                                                            @csrf
                                                            <input type="hidden" name="canteen_id" value="{{ $canteen->id }}">
                                                            <div class="row g-2 mb-2">
                                                                <div class="col-md-6">
                                                                    <div class="form-floating">
                                                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" placeholder="Food Name" readonly>
                                                                        <label for="name" class="text-dark">Food Name</label>
                                                                        @error('name')
                                                                        <div class="invalid-feedback mt-2">
                                                                            {{ $message }}
                                                                        </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-floating">
                                                                        <div class="form-floating">
                                                                            <input id="type" type="text" class="form-control @error('type') is-invalid @enderror" name="type" value="veg" placeholder="Food Type" readonly>
                                                                            <label for="type" class="text-dark">Food Type</label>
                                                                            @error('type')
                                                                            <div class="invalid-feedback mt-2">
                                                                                {{ $message }}
                                                                            </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row g-2 mb-2">
                                                                <div class="col-md-6">
                                                                    <div class="form-floating">
                                                                        <input id="count" type="number" class="form-control @error('count') is-invalid @enderror" name="count" value="" placeholder="Food Count" min="1">
                                                                        <label for="count" class="text-dark">Food Count</label>
                                                                        @error('count')
                                                                        <div class="invalid-feedback mt-2">
                                                                            {{ $message }}
                                                                        </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-floating">
                                                                        <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="" placeholder="Food Price" readonly>
                                                                        <label for="price" class="text-dark">Food Price</label>
                                                                        @error('price')
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
                    @endforeach
                </div>
                @else
                    <h1 class="h4"><span class="badge bg-info">Currently Food not added!</span></h1>
                @endif
            </div>
            <div class="tab-pane" id="nonveg" role="tabpanel" aria-labelledby="non-veg-tab">
                <h3 class="fs-4 mt-3 mb-3 fw-bold">NonVeg Food!</h3>
                @if(count($foodItemsNonVeg) > 0)
                    @foreach($foodItemsNonVeg as $nonveg)
                    <div class="col-12 col-md-6 gy-4">
                        <div class="py-3 border bg-white">
                          <div class="row">
                            <div class="col-3 align-self-center">
                              <div class="ratio ratio-1x1">
                                <img class="object-fit-cover" src="../../img/food/{{ $nonveg->image }}" alt="...">
                              </div>
                            </div>
                            <div class="col-7">
                              <h5 class="mb-2">{{ $nonveg->name }}</h5>
                              <p class="mb-0">
                                {{ $nonveg->description }}
                              </p>
                              <input type="hidden" value="{{ $nonveg->id }}">
                              <input type="hidden" value="{{ $nonveg->name }}">
                              <input type="hidden" value="{{ $nonveg->price }}">
                              <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#placeOrderNonVeg" onclick="placeOrderBtnNonVeg(this)">Place Order</button>
                            </div>
                            <div class="col-2">
                              <div class="fs-4 font-serif text-center text-black">
                                ₹{{ $nonveg->price }}
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="modal fade" id="placeOrderNonVeg" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Place Order</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" id="placeOrderItemsNonVeg">
                                    <form method="post" action="{{ route('order.store') }}">
                                        @csrf
                                        <input type="hidden" name="canteen_id" value="{{ $canteen->id }}">
                                        <div class="row g-2 mb-2">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input id="nonname" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" placeholder="Food Name" readonly>
                                                    <label for="nonname" class="text-dark">Food Name</label>
                                                    @error('name')
                                                    <div class="invalid-feedback mt-2">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <div class="form-floating">
                                                        <input id="type" type="text" class="form-control @error('type') is-invalid @enderror" name="type" value="non-veg" placeholder="Food Type" readonly>
                                                        <label for="type" class="text-dark">Food Type</label>
                                                        @error('type')
                                                        <div class="invalid-feedback mt-2">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-2 mb-2">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input id="count" type="number" class="form-control @error('count') is-invalid @enderror" name="count" value="" placeholder="Food Count" min="1">
                                                    <label for="count" class="text-dark">Food Count</label>
                                                    @error('count')
                                                    <div class="invalid-feedback mt-2">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input id="nonprice" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="" placeholder="Food Price" readonly>
                                                    <label for="nonprice" class="text-dark">Food Price</label>
                                                    @error('price')
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
                    @endforeach
                @else
                    <h1 class="h4"><span class="badge bg-info">Currently Food not added!</span></h1>
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
<script>
function placeOrderBtnVeg(a){
    console.log(a.parentNode.children);
    console.log(a.parentNode.children[2].value);
    console.log(a.parentNode.children[3].value);
    console.log(a.parentNode.children[5].value);
    var itemName = a.parentNode.children[3].value;
    // alert(itemName);
    var foodNameBox = document.getElementById('name');
    // alert(foodNameBox);
    foodNameBox.value = itemName;
    var itemPrice = a.parentNode.children[4].value;
    var foodPriceBox = document.getElementById('price');
    // alert(foodPriceBox);
    foodPriceBox.value = itemPrice;
}

function placeOrderBtnNonVeg(a){
    console.log(a.parentNode.children);
    console.log(a.parentNode.children[2].value);
    console.log(a.parentNode.children[3].value);
    console.log(a.parentNode.children[4].value);
    console.log(a.parentNode.children[5].value);
    var itemName = document.getElementById('nonname');
    itemName.value = a.parentNode.children[3].value;

    var itemPrice = document.getElementById('nonprice');
    itemPrice.value = a.parentNode.children[4].value;
}
</script>
@endsection