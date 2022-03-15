@extends('layouts.app')

@section('custom-title')
Canteen Details
@endsection

@section('content')
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
                                        <option value="veg" selected>Veg</option>
                                        {{-- <option value="non-veg">Non Veg</option> --}}
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
                                    <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" placeholder="Food Half Price">
                                    <label for="price" class="text-dark">Food Price</label>
                                    @error('price')
                                    <div class="invalid-feedback mt-2">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
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
                        <div class="row g-2 mb-2">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Description" name="description" id="description" style="height: 100px"></textarea>
                                    <label for="description">Description</label>
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
                <h3 class="fs-4 mt-3 mb-0 fw-bold">Veg Food!</h3>
                @if(count($foodItemsVeg) > 0)
                <div class="row">    
                    @foreach($foodItemsVeg as $veg)
                    <div class="col-12 col-md-6 gy-4">
                        <div class="py-3 border bg-white">
                          <div class="row">
                            <div class="col-3 align-self-center">
                              <div class="ratio ratio-1x1">
                                <img class="object-fit-cover" src="../../img/food/{{ $veg->image }}" alt="...">
                              </div>
                            </div>
                            <div class="col-7">
                              <h5 class="mb-2 fs-2">{{ $veg->name }}</h5>
                              <p class="mb-0 fs-6">
                                {{ $veg->description }}
                              </p>
                            </div>
                            <div class="col-2">
                              <div class="fs-4 font-serif text-center text-black">
                                ₹{{ $veg->price }}
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
                            </div>
                            <div class="col-2">
                              <div class="fs-4 font-serif text-center text-black">
                                ₹{{ $nonveg->price }}
                              </div>
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
@endsection