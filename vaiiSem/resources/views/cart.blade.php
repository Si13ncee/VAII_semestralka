@extends('layouts.app')

@section('content')
<div class="container mt-4 card no-hover no-transition">
    <h2>Váš košík</h2>
    
    @if(Auth::check())
        @foreach($cartItems as $item)
            <div class="card no-hover no-transition mb-3">
                <div class="card-body d-flex">
                    <div class="me-4">
                        <img src="{{ asset('ProductImages/uploads/products/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="img-fluid" style="max-width: 100px; max-height: 100px; object-fit: cover;">
                    </div>
                    <div class="d-flex flex-column justify-content-between">
                        <h5 class="card-title">{{ $item->product->name }}</h5>
                        <p class="card-text">Cena: {{ $item->product->price }} €</p>
                        
                        <!-- Formulár pre aktualizáciu množstva -->
                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <div class="d-flex align-items-center">
                                <button type="submit" name="action" value="decrease" class="btn btn-secondary">-</button>
                                <input type="number" name="pocet" value="{{ $item->pocet }}" min="1" class="form-control d-inline-block w-auto mx-2" />
                                <button type="submit" name="action" value="increase" class="btn btn-secondary">+</button>
                            </div>
                        </form>
                        <p class="card-text">Celková cena: {{ $item->product->price * $item->pocet }} €</p>

                        <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Určite chcete odstrániť tento produkt z košíka?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mt-2">Odstrániť z košíka</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        @foreach($cartItems as $id => $item)
            <div class="card no-hover no-transition mb-3">
                <div class="card-body d-flex">
                    <div class="me-4">
                        <img src="{{ asset('ProductImages/uploads/products/' . $item['image']) }}" alt="{{ $item['name'] }}" class="img-fluid" style="max-width: 100px; max-height: 100px; object-fit: cover;">
                    </div>
                    <div class="d-flex flex-column justify-content-between">
                        <h5 class="card-title">{{ $item['name'] }}</h5>
                        <p class="card-text">Cena: {{ $item['price'] }} €</p>
                        
                        <form action="{{ route('cart.update', $id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <div class="d-flex align-items-center">
                                <button type="submit" name="action" value="decrease" class="btn btn-secondary">-</button>
                                <input type="number" name="pocet" value="{{ $item['pocet'] }}" min="1" class="form-control d-inline-block w-auto mx-2" />
                                <button type="submit" name="action" value="increase" class="btn btn-secondary">+</button>
                            </div>
                        </form>
                        <p class="card-text">Celková cena: {{ $item['price'] * $item['pocet'] }} €</p>

                        <form action="{{ route('cart.remove', $id) }}" method="POST" onsubmit="return confirm('Určite chcete odstrániť tento produkt z košíka?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mt-2">Odstrániť z košíka</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    <div class="text-center mt-4 mb-4">
        <a href="{{ route('checkout.address') }}" class="btn btn-primary bg-dark">Pokračovať k fakturačnej adrese</a>
    </div>

</div>



@endsection
