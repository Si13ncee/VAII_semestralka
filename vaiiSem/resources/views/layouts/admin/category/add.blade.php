@extends('layouts.adminPage')

@section('content')
<div class="px-5">
    <div class="col py-2">
        <div class="card no-hover no-transition mt-3">
            <div class="card-header">
                Add Category
            </div>
            <div class="card-body">
                <form id="category-form" action="{{ url('addNewCategory') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">Name</label>
                            <input type="text" id="name" class="form-control" name="name">
                            <small id="name-error" class="text-danger"></small>
                        </div>                    
                    </div>   
                    <div class="col-md-12 mt-4">
                        <button type="submit" class="btn btn-primary bg-green">Submit</button>
                    </div>                 
                </form>
                
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('category-form').addEventListener('submit', function (e) {
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
