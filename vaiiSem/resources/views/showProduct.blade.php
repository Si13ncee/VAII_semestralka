@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row card no-transition no-hover">
        <div class="col-md-4 mb-4 mt-4">
            <img src="{{ asset('ProductImages/uploads/products/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
        </div>
        <div class="col-md-8 mb-4">
            <h1>{{ $product->name }}</h1>
            <p><strong>Cena:</strong> {{ $product->price }} €</p>
            <p><strong>Hodnotenie:</strong> ⭐ {{ $product->rating }} ({{ $product->rating_count }} hodnotení)</p>
            <p>{{ $product->description }}</p>
            
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Pridať do košíka</button>
            </form>
            
            
        </div>
    </div>
    <!-- Formulár na pridanie recenzie len pre prihlásených -->
    @auth
    <div class="container mt-4">
        <div class="row card no-transition no-hover">
            <hr>
            <h4>Pridajte recenziu:</h4>
            <form action="{{ route('reviews.store', $product->id) }}" method="POST">
                @csrf
                <input type="hidden" name="author" value="{{ Auth::user()->name }}">
                
                <div class="form-group">
                    <label for="rating">Hodnotenie:</label>
                    <select name="rating" id="rating" class="form-control" required>
                        <option value="1">1 - Najhoršie</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5 - Najlepšie</option>
                    </select>
                </div>
                <div class="form-group mt-2">
                    <label for="review">Recenzia:</label>
                    <textarea name="review" id="review" class="form-control" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-2 mb-2 bg-dark">Pridať recenziu</button>
            </form>
            @endauth
            <!-- Ak nie je prihlásený používateľ -->
            @guest
            <p>## Pre pridanie recenzie sa musíte prihlásiť ##</p>
            @endguest
        </div>
    </div>
    
    <div class="container mt-4">
        <div class="row" id="reviews-list">
            <!-- Recenzie sa načítajú sem pomocou AJAX -->
        </div>
        <div id="loading" class="text-center" style="display: none;">
            <p>Načítavam...</p>
        </div>
    </div>
    

<script>
    $(document).ready(function () {
        let page = 1; // Počiatočná stránka
        let productId = {{ $product->id }}; // ID produktu, na ktorom sa nachádzame
        let loading = false;
    
        function loadReviews() {
            if (loading) return;
    
            loading = true;
            $('#loading').show(); // Zobraziť "Načítavam" správu
    
            $.ajax({
                url: '/product/' + productId + '/reviews',
                type: 'GET',
                data: { page: page },
                dataType: 'json',
                success: function (response) {
                    if (response.length > 0) {
                        response.forEach(review => {
                            $('#reviews-list').append(`
                                <div class="review my-1 card">
                                    <h5>${review.author}</h5>
                                    <p>⭐ ${review.rating}</p>
                                    <p>${review.review}</p>
                                </div>
                            `);
                        });
                        page++; 
                    }
                    loading = false;
                    $('#loading').hide();
                },
                error: function () {
                    alert('Chyba pri načítaní recenzií.');
                    loading = false;
                    $('#loading').hide();
                }
            });
        }

        loadReviews();

        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                loadReviews();
            }
        });
    });

    </script>

</div>
@endsection
