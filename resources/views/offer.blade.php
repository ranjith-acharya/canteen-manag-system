@extends('layouts.app')

@section('custom-title')
Offers
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
    <h4 class="display-6 fs-1 mb-2">Offers Details 🆕</h4><hr>
    <div class="table-responsive">
        <table id="offerDetails" class="table table-sm table-striped" style="width:100%;">
        <thead>
            <tr>
                <th>Name</th>
                <th>Offer Percentage</th>
                <th>Code</th>
                <th>Created at</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($offers as $offer)
            <tr>
                <td>{{ $offer->name }}</td>
                <td>{{ $offer->percentage }}&nbsp;%</td>
                <td><h4 class="h4 badge bg-primary">{{ $offer->code }}</h4></td>
                <td>{{ Carbon\Carbon::parse($offer->created_at)->diffForHumans() }}</td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</div>
@endsection

@section('custom-js')
<script>
$(document).ready(function(){
    $('.toast').toast('show');
    $('#offerDetails').DataTable();
});
</script>
@endsection