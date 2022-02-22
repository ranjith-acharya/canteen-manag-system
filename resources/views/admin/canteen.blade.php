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
    <form method="post" action="{{ route('admin.set.status') }}">
    @csrf
    <input type="hidden" name="canteen_id" value="{{ $canteen->id }}">
    <div class="col-md-4 mb-2">
        <div class="form-floating">
            <select class="form-select @error('status') is-invalid @enderror" name="status" id="status">
                <option selected disabled>Select Status</option>
                <option value="active" @if($canteen->status == 'active') selected @endif>Active</option>
                <option value="in active" @if($canteen->status == 'in active') selected @endif>In Active</option>
            </select>
            <label for="status" class="text-dark">Select Status</label>
            @error('status')
            <div class="invalid-feedback mt-2">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <input type="submit" class="btn btn-sm btn-success" value="Update Status">
        <button type="button" data-bs-toggle="modal" data-bs-target="#addFoodItem" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i>&nbsp;Food</button>
    </div>
    </form>
    <div class="row">
        {{-- <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
            <div class="card-body">
                <div class="row align-items-center text-center g-2">
                    <div class="col-6">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#addFoodItem" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i>&nbsp;Food</button>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="modal fade" id="addFoodItem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Food Item</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.food.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="canteen_id" value="{{ $canteen->id }}">
                        <div class="row g-2 mb-2">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Food Name">
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
                                    <select class="form-select @error('type') is-invalid @enderror" name="type" id="type">
                                        <option selected disabled>Select Type</option>
                                        <option value="veg">Veg</option>
                                        <option value="non-veg">Non Veg</option>
                                      </select>
                                      <label for="type" class="text-dark">Select Type</label>
                                    @error('type')
                                    <div class="invalid-feedback mt-2">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row g-2 mb-2">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input id="half_price" type="text" class="form-control @error('half_price') is-invalid @enderror" name="half_price" value="{{ old('half_price') }}" placeholder="Food Half Price">
                                    <label for="half_price" class="text-dark">Food Half Price</label>
                                    @error('half_price')
                                    <div class="invalid-feedback mt-2">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input id="full_price" type="text" class="form-control @error('full_price') is-invalid @enderror" name="full_price" value="{{ old('full_price') }}" placeholder="Food Full Price">
                                    <label for="full_price" class="text-dark">Food Full Price</label>
                                    @error('full_price')
                                    <div class="invalid-feedback mt-2">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row g-2 mb-2">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" placeholder="Choose Image" accept="image/*">
                                    <label for="image" class="text-dark">Choose Image</label>
                                    @error('image')
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
    </div>
    @if(count($foodItems) > 0)
        <div class="row">
            @foreach($foodItems as $foodItem)
            <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                <div class="card overflow-hidden @if($foodItem->type == 'veg') border-success @else border-danger @endif">
                    <div class="row g-0">
                        <div class="col-sm-5">
                            <img src="../../img/food/{{ $foodItem->image }}" class="bg-repeat-0 bg-position-center bg-size-cover img-fluid" style="height: 10rem; width:100%;" alt="{{ $foodItem->name }}">
                        </div>
                        {{-- <a href="#" class="col-sm-4 bg-repeat-0 bg-position-center bg-size-cover" style="background-image: url(../../img/food/{{ $foodItem->image }}); min-height: 10rem;"></a> --}}
                        <div class="col-sm-7">
                            <div class="card-body">
                                <div class="fs-sm text-muted mb-1">
                                    @if($foodItem->type == 'veg')
                                        <span class="fs-6 text-success"><i class="bi bi-record-circle-fill text-success"></i>&nbsp;Veg</span>
                                    @else
                                        <span class="fs-6 text-danger"><i class="bi bi-record-circle-fill text-danger"></i>&nbsp;Non-Veg</span>
                                    @endif
                                </div>
                                <h2 class="h4 pb-1 mb-2">
                                    {{ $foodItem->name }}<br>
                                    <span class="fs-6">₹{{ $foodItem->half_price }}&nbsp;/&nbsp;₹{{ $foodItem->full_price }}</span>
                                </h2>
                            </div>
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
@endsection

@section('custom-js')
<script>
$(document).ready(function(){
    $('.toast').toast('show');
});
</script>
@endsection