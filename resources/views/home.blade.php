@extends('layouts.app')

@section('custom-title')
Home
@endsection

@section('content')
<div class="container">
    <h1 class="display-6 fw-bold"><span class="d-inline-block me-3">👋</span>Hi, {{Auth::user()->name}}!</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
