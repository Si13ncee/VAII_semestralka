@extends('layouts.adminPage')
@section('content')

    <div class="px-5">
        <div class="col py-2">
            <div class="card no-hover no-transition mt-3">
                <div class="card-header">
                    <h1>Product Page</h1>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($products as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>                                                        
                                    <td>
                                        <img src="{{ asset('ProductImages/uploads/products/' . $item->image ) }}" class="w-25" alt="image">
                                    </td>
                                    <td>{{ $item->price }}</td>
                                    <td>
                                        <a href="{{ url('edit-product/' . $item->id ) }}" class=" btn btn-secondary mb-1"> Edit </a>
                                        <a href="{{ route('deleteProduct', $item->id) }}" class="btn btn-danger"> Delete </a>  
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection