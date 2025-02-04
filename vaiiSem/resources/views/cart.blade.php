@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Váš košík</h2>
    
    @if(Auth::check())
        @foreach($cartItems as $item)
            <div class="card no-hover no-transition mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->product->name }}</h5>
                    <p class="card-text">Cena: {{ $item->product->price }} €</p>
                    <p class="card-text">Množstvo: {{ $item->pocet }}</p>
                    <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Určite chcete odstrániť tento produkt z košíka?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    @else
        @foreach($cartItems as $id => $item)
            <div class="card no-hover no-transition mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $item['name'] }}</h5>
                    <p class="card-text">Cena: {{ $item['price'] }} €</p>
                    <p class="card-text">Množstvo: {{ $item['pocet'] }}</p>
                    <form action="{{ route('cart.remove', $id) }}" method="POST" onsubmit="return confirm('Určite chcete odstrániť tento produkt z košíka?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
