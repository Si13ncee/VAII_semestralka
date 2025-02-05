@extends('layouts.adminPage')

@section('content')

    <div class="px-5 container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card position-relative">
                    <div class="card-body">
                        <i class="bi bi-cart-x"></i>
                        <span>Number of unprocessed orders: {{ $unprocessedOrders }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card position-relative">
                    <div class="card-body">
                        <i class="bi bi-cart-x"></i>
                        <span>Number of unprocessed orders: {{ $unprocessedOrders }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card position-relative">
                    <div class="card-body">
                        <i class="bi bi-cart-x"></i>
                        <span>Number of unprocessed orders: {{ $unprocessedOrders }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection