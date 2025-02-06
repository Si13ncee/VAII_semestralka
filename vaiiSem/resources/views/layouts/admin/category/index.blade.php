@extends('layouts.adminPage')
@section('content')

    <div class="px-5">
        <div class="col py-2">
            <div class="card no-hover no-transition mt-3">
                <div class="card-header">
                    <h1>Categories</h1>
                    <a href="{{ url('newCategory') }}" class=" btn btn-primary bg-dark"> Add New Category </a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>                        
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <a href="{{ url('editCategory/' . $category->id ) }}" class=" btn btn-secondary"> Edit </a>
                                        <a href="{{ route ('deleteCategory', ['id' => $category->id])}}" class=" btn btn-danger"> Delete </a>
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