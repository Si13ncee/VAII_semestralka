@extends('layouts.app')

@section('content')
<div class="container mt-4 card no-hover no-transition bg-gray">
    <h2 class="text-center mt-4 mb-4">Fakturačné údaje</h2>

    <form action="{{ route('checkout.review') }}" method="POST">
        @csrf
        
        
        <div class="mb-3 card">
            <div class="mt-3 ms-3 me-3">
                <label for="name" class="form-label">Meno</label>
            </div>
            <div class="mb-3 ms-3 me-3">
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
        </div>

        
        <div class="mb-3 card">
            <div class="mt-3 ms-3 me-3">
                <label for="email" class="form-label">Email</label>
            </div>
            <div class="mb-3 ms-3 me-3">
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
        </div>

       
        <div class="mb-3 card">
            <div class="mt-3 ms-3 me-3">
                <label for="address" class="form-label">Adresa</label>
            </div>
            <div class="mb-3 ms-3 me-3">
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
        </div>

        
        <div class="mb-3 card">
            <div class="mt-3 ms-3 me-3">
                <label for="city" class="form-label">Mesto</label>
            </div>
            <div class="mb-3 ms-3 me-3">
                <input type="text" class="form-control" id="city" name="city" required>
            </div>
        </div>

        
        <div class="mb-3 card">
            <div class="mt-3 ms-3 me-3">
                <label for="postal_code" class="form-label">PSČ</label>
            </div>
            <div class="mb-3 ms-3 me-3">
                <input type="text" class="form-control" id="postal_code" name="postal_code" required>
            </div>
        </div>

       
        <div class="mb-3 card">
            <div class="mt-3 ms-3 me-3">
                <label for="phone_number" class="form-label">Telefónne číslo</label>
            </div>
            <div class="mb-3 ms-3 me-3">
                <input type="text" class="form-control" id="phone_number" name="phone_number" required>
            </div>
        </div>

        
        <div class="d-flex mb-3 justify-content-center"><button type="submit" class="btn btn-primary bg-dark">Dokončiť Objednávku</button></div>
    </form>
</div>
@endsection
