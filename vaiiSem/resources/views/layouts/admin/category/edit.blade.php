@extends('layouts.adminPage')

@section('content')
<div class="px-5">
    <div class="col py-2">
        <div class="card no-hover no-transition mt-3">
            <div class="card-header">
                Edit Category {{ $category->id }}
            </div>
            <div class="card-body">
                <form id="edit-category-form" action="{{ route('updateCategory', ['id' => $category->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">Name</label>
                            <input type="text" id="name" value="{{ $category->name }}" class="form-control" name="name" required>
                            <small id="name-error" class="text-danger"></small>

                        <div class="col-md-12 mt-3">
                            <button type="submit" class="btn btn-primary bg-green">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('edit-category-form').addEventListener('submit', function (e) {
        let valid = true;

        // Clear previous errors
        document.querySelectorAll('.text-danger').forEach(error => error.textContent = '');

        // Validate Name
        const name = document.getElementById('name');
        if (name.value.trim() === '') {
            valid = false;
            document.getElementById('name-error').textContent = 'Name is required.';
        }
        
        if (!valid) {
            e.preventDefault();
        }
    });
</script>
@endsection
