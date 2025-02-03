@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4 mb-4 ">
            <img src="{{ asset('ProductImages/uploads/products/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
        </div>
        <div class="col-md-4 mb-4 d-flex flex-column">
            <h1>{{ $product->name }}</h1>
            <p><strong>Cena:</strong> {{ $product->price }} €</p>
            <p><strong>Hodnotenie:</strong> ⭐ {{ $product->rating }} ({{ $product->rating_count }} hodnotení)</p>
            <p>{{ $product->description }}</p>
            <a href="#" class="btn btn-primary">Pridať do košíka</a>
        </div>
    </div>
</div>
@endsection
