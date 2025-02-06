<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tech H4ven</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Bootstrap CSS -->
  <!-- Styles -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ asset('frontend/css/style_main.css') }}" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body class="d-flex flex-column min-vh-100 bg-gray">

    <div class="wrapper">
        @include('layouts.siteParts.navbar')
    </div>  

  <!-- Header -->
  <header class="jumbotron jumbotron-fluid header-bg">
    <div class="container text-center ">
      <h4>Welcome to</h4>
      <h1>Tech H4ven</h1>
      <br>
      <p>Looking to buy the newest technology?</p>
      <p>Don't worry, you need to look no further!</p>
      <a class="btn btn-primary bg-dark"  href="{{ url('/catalogue') }}">Browse Catalogue</a>
    </div>
  </header>
  
<div class="container mt-4 text-center">
  <form class="search-form form-inline justify-content-center">
    <div class="row">
        <div class="col">
            <input id="search-input" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        </div>
        <div class="col-md-auto">
            <select id="sort-select" class="form-select ml-2 custom-dropdown">
                <option value="price_asc">Cena (od najnižšej)</option>
                <option value="price_desc">Cena (od najvyššej)</option>
                <option value="rating_desc">Hodnotenie (najlepšie)</option>
                <option value="rating_asc">Hodnotenie (najhoršie)</option>
            </select>
        </div>
        <div class="col-md-auto">
            <button class="btn btn-outline-primary my-2 my-sm-0 custom-btn-outline ml-2" type="submit">Search</button>
        </div>
    </div>
    <div class="row">   
        <div class="d-flex flex-wrap mt-3">
            @foreach ($categories as $category)
                <div class="d-flex align-items-center me-3">
                    <label class="btn btn-primary me-2 mb-0 bg-dark" for="category{{ $category->id }}">
                        {{ $category->name }}
                    </label>
                    <input type="checkbox" name="categories[]" value="{{ $category->id }}" 
                        class="form-check-input mt-0" 
                        id="category{{ $category->id }}">
                </div>
            @endforeach
        </div>
    </div>
  </form>
</div>
    
  


<main>
    <div class="container mt-4">
      <div class="row" id="product-list">
          <!-- Produkty sa pridajú sem pomocou AJAX-u -->
      </div>
  </div>

    </div>
  </main>



<script>
  $(document).ready(function () {
    let page = 1;
    let searchQuery = ""; 
    let loading = false;
    let hasMoreData = true;
    let sortBy = $("#sort-select").val();
    let selectedCategories = [];


    function truncateText(text, maxLength) {
        return text.length > maxLength ? text.substring(0, maxLength) + "..." : text;
    }


    function loadProducts() {
        if (!hasMoreData || loading) return;

        loading = true;
        $.ajax({
            url: "/search",
            type: "GET",
            data: { 
                query: searchQuery, 
                categories: selectedCategories, 
                page: page, 
                sortBy: sortBy 
            },
            dataType: "json",
            success: function (response) {
                if (response.data.length > 0) {
                    response.data.forEach(product => {
                        $("#product-list").append(`
                            <div class="col-md-4 mb-4">
                                <div class="card position-relative">
                                    <img src="ProductImages/uploads/products/${product.image}" alt="${product.name}" class="card-img-top">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title"><a href="/product/${product.id}">${product.name}</a></h5>
                                        <p class="card-text">${truncateText(product.description, 100)}</p>
                                        <p class="card-text"><strong>Cena:</strong> ${product.price} €</p> 

                                        <div class="mt-auto d-flex justify-content-between align-items-center">
                                            <form action="/cart/add/${product.id}" method="POST">
                                                <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                                                <button type="submit" class="btn btn-primary">Pridať do košíka</button>
                                            </form>
                                            <div class="rating text-muted small text-end">
                                                ⭐ ${product.rating} (${product.rating_count})
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `);
                    });
                    page++;
                } else {
                    hasMoreData = false;
                }
                loading = false;
            },
            error: function () {
                alert("Chyba pri načítaní produktov!");
                loading = false;
            }
        });
    }

    $(".search-form").submit(function (event) {
        event.preventDefault();
        
        searchQuery = $("#search-input").val();
        page = 1;
        hasMoreData = true;

        selectedCategories = [];
        $("input[name='categories[]']:checked").each(function() {
            selectedCategories.push($(this).val());
        });

        $("#product-list").html(""); 
        loadProducts();
    });

    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
            loadProducts();
        }
    });

    $("#sort-select").change(function () {
        sortBy = $(this).val();
        page = 1;
        hasMoreData = true;
        $("#product-list").html("");
        loadProducts();
    });
});

</script>



    

  <div class="wrapper">
        @include('layouts.siteParts.footer')
    </div>  


  <!-- Bootstrap JS and dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>