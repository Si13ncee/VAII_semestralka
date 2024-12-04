@extends('layouts.adminPage')

@section('content')
<div class="px-5">
    <div class="col py-2">
        <div class="card nonhoverable-card">
            <div class="card-header">
                Edit Product
            </div>
            <div class="card-body">
                <form id="edit-product-form" action="{{ route('updateProduct', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">Name</label>
                            <input type="text" id="name" value="{{ $product->name }}" class="form-control" name="name" required>
                            <small id="name-error" class="text-danger"></small>
                        </div>
                        <div class="col-md-6">
                            <label for="slug">Slug</label>
                            <input type="text" id="slug" value="{{ $product->slug }}" class="form-control" name="slug" required>
                            <small id="slug-error" class="text-danger"></small>
                        </div>
                        <div class="col-md-12">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" cols="30" rows="5" class="form-control" required>{{ $product->description }}</textarea>
                            <small id="description-error" class="text-danger"></small>
                        </div>
                        <div class="col-md-12">
                            @if($product->image)
                                <div class="mb-2">
                                    <img src="{{ asset('ProductImages/uploads/products/'.$product->image) }}" alt="Product Image" class="img-thumbnail mb-2">
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="delete-image" name="delete_image">
                                    <label class="form-check-label" for="delete-image">Delete current image</label>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <label for="image">New Image (optional)</label>
                            <input type="file" id="image" name="image" class="form-control" accept="image/*">
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
    document.getElementById('edit-product-form').addEventListener('submit', function (e) {
        let valid = true;

        // Clear previous errors
        document.querySelectorAll('.text-danger').forEach(error => error.textContent = '');

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
        if (image.files.length > 0) {
            const file = image.files[0];
            const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!validTypes.includes(file.type)) {
                valid = false;
                document.getElementById('image-error').textContent = 'Only JPEG, PNG, and GIF formats are allowed.';
            }
        }

        if (!valid) {
            e.preventDefault();
        }
    });
</script>
@endsection
