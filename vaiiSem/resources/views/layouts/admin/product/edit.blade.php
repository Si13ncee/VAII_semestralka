@extends('layouts.adminPage')

@section('content')


    <div class="px-5">
        <div class="col py-2">
            <div class="card nonhoverable-card">
                <div class="card-header">
                    Edit Product
                </div>
                <div class="card-body">
                    <form action="{{ route('updateProduct', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Name</label>
                                <input type="text" value="{{ $product->name }}" class="form-control" name="name">
                            </div>
                            <div class="col-md-6">
                                <label for="">slug</label>
                                <input type="text" value="{{ $product->slug }}" class="form-control" name="slug">
                            </div>
                            <div class="col-md-12">
                                <textarea name="description" cols="30" rows="5" class="form-control">{{ $product->description }}</textarea>
                            </div>
                            <div class="col-md-3">

                            @if($product->image)
                                <img src="{{ asset('ProductImages/uploads/products/'.$product->image) }}" alt="Product Image">
                            @endif
                            <div class="col-md-12">
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>                                        
@endsection