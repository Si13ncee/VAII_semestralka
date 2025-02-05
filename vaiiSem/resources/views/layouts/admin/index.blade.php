@extends('layouts.adminPage')

@section('content')

    <div class="px-5 container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card position-relative">
                    <div class="card-body d-flex flex-column">
                        <i class="bi bi-cart-x fs-3"></i>
                        <span>Number of unprocessed orders: {{ $unprocessedOrders }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card position-relative">
                    <div class="card-body d-flex flex-column">
                        <i class="bi bi-box fs-3"></i>
                        <span>Number of products in Catalogue: {{ $items }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card position-relative">
                    <div class="card-body d-flex flex-column">
                        <i class="bi bi-diagram-3 fs-3"></i>
                        <span>Number of registered users: {{ $noUsers }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection