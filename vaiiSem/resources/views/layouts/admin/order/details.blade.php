@extends('layouts.adminPage')
@section('content')

    <div class="px-5">
        <div class="col py-2">
            <div class="card">
                <div class="card-header">
                    <div class="card">
                        <h1>Details of Order id: {{ $order->id }}</h1>
                    </div>
                    <div class="card">
                        <div class ="ml-4 mb-1">ID: {{ $order->id }}</div>
                        <div class ="ml-4 mb-1">Meno: {{ $order->name }}</div>
                        <div class ="ml-4 mb-1">E-mail: {{ $order->email }}</div>
                        <div class ="ml-4 mb-1">Address: {{ $order->address }}</div>
                    </div>
                    </div>
                
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Názov produktu</th>
                                <th>Cena produktu</th>
                                <th>Kvantita produktu</th>
                                <th>Celková Suma</th>
                            </tr>
                        </thead>
                        <tbody>                         
                            @foreach ($orderedItems as $item)
                                <tr>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->quantity }}</td>    
                                    <td>{{ $item->price * $item->quantity }}</td>                                                                                                         
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="{{ url('completeOrder/' . $order->id ) }}" class="btn btn-primary bg-green"> Complete Order {{ $order->id }} </a>
            </div>
        </div>
    </div>

@endsection