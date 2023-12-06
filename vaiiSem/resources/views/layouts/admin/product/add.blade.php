@extends('layouts.adminPage')

@section('content')


    <div class="px-5">
        <div class="col py-2">
            <div class="card">
                <div class="card-header">
                    Add Product
                </div>
                <div class="card-body">
                    <form action="{{ url('insert-category') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="col-md-6">
                                <label for="">slug</label>
                                <input type="text" class="form-control" name="slug">
                            </div>
                            <div class="col-md-12">
                            <textarea name="description" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="col-md-3">
                                <label for="">meta_title</label>
                                <input type="text" class="form-control" name="meta_title">
                            </div>
                            <div class="col-md-6">
                                <label for="">meta_description</label>
                                <input type="text" class="form-control" name="meta_description">
                            </div>
                            <div class="col-md-6">
                                <label for="">meta_keywords</label>
                                <input type="text" class="form-control" name="meta_keywords">
                            </div>
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