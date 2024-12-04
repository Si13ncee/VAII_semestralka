@extends('layouts.adminPage')

@section('content')
<div class="px-5">
    <div class="col py-2">
        <div class="card">
            <div class="card-header">
                Add Product
            </div>
            <div class="card-body">
                <form id="product-form" action="{{ url('insert-product') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">Name</label>
                            <input type="text" id="name" class="form-control" name="name" required>
                            <small id="name-error" class="text-danger"></small>
                        </div>
                        <div class="col-md-6">
                            <label for="slug">Slug</label>
                            <input type="text" id="slug" class="form-control" name="slug" required>
                            <small id="slug-error" class="text-danger"></small>
                        </div>
                        <div class="col-md-12">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" cols="30" rows="5" class="form-control" required></textarea>
                            <small id="description-error" class="text-danger"></small>
                        </div>
                        <div class="col-md-12">
                            <label for="image">Image</label>
                            <input type="file" id="image" name="image" class="form-control" accept="image/*" required>
                            <small id="image-error" class="text-danger"></small>
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

<script>
    document.getElementById('product-form').addEventListener('submit', function (e) {
        let valid = true;

        // Validate Name
        const name = document.getElementById('name');
        if (name.value.trim() === '') {
            valid = false;
            document.getElementById('name-error').textContent = 'Name is required.';
        }

        // Validate Slug
        const slug = document.getElementById('slug');
        if (slug.value.trim() === '') {
            valid = false;
            document.getElementById('slug-error').textContent = 'Slug is required.';
        }

        // Validate Description
        const description = document.getElementById('description');
        if (description.value.trim() === '') {
            valid = false;
            document.getElementById('description-error').textContent = 'Description is required.';
        }

        // Validate Image
        const image = document.getElementById('image');
        if (!image.files.length) {
            valid = false;
            document.getElementById('image-error').textContent = 'Image is required.';
        }

        if (!valid) {
            e.preventDefault();
        }
    });
</script>
@endsection
