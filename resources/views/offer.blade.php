@extends('layouts.app')

@section('custom-title')
Offers
@endsection

@section('content')
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