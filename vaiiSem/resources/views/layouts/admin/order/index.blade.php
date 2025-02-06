@extends('layouts.adminPage')
@section('content')

    <div class="px-5">
        <div class="col py-2">
            <div class="card no-hover no-transition mt-3">
                <div class="card-header">
                    <h1>Order</h1>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>E-mail</th>
                                <th>Address</th>
                                <th>Number of Items</th>
                                <th>View Order</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->email }}</td>                                                        
                                    <td>{{ $order->address }}</td>
                                    <td>{{ $orderedItems->where('order_id', $order->id)->sum('quantity')}}</td>
                                    @if ($order->status == 'pending')
                                        <td><a href="{{ url('viewOrder/' . $order->id ) }}" class=" btn btn-primary bg-dark"> View Details </a></td>  
                                    @endif
                                    @if ($order->status == 'completed')
                                        <td><i class="bi bi-check-all"></i></td>                         
                                    @endif
                                    @if ($order->status == 'cancelled')
                                        <td><i class="bi bi-x-square-fill"></i></td>                         
                                    @endif                                    
                                </tr>
                            @endforeach



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection