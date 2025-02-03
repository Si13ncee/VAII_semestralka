<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tech H4ven</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('frontend/css/style_main.css') }}" rel="stylesheet">
  
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
      <a class="btn btn-primary bg-dark"  href="catalogue.html">Browse Catalogue</a>
    </div>
  </header>
  
<!-- Spojené vyhľadávacie pole a filter na zoradenie -->
<div class="container mt-4 text-center">
  <form class="search-form form-inline justify-content-center d-flex">
      <!-- Vyhľadávacie pole -->
      <input id="search-input" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      
      <!-- Dropdown menu na triedenie, menšia veľkosť -->
      <select id="sort-select" class="form-select ml-2 custom-dropdown">
          <option value="price_asc">Cena (od najnižšej)</option>
          <option value="price_desc">Cena (od najvyššej)</option>
          <option value="rating_desc">Hodnotenie (najlepšie)</option>
          <option value="rating_asc">Hodnotenie (najhoršie)</option>
      </select>

      <!-- Tlačidlo na vyhľadávanie -->
      <button class="btn btn-outline-primary my-2 my-sm-0 custom-btn-outline ml-2" type="submit">Search</button>
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
    let sortBy = $("#sort-select").val(); // Defaultne zoradenie podľa ceny

    function truncateText(text, maxLength) {
        return text.length > maxLength ? text.substring(0, maxLength) + "..." : text;
    }

    function loadProducts() {
        if (!hasMoreData || loading) return;

        loading = true;
        $.ajax({
            url: "/search", // Uistite sa, že toto je správna URL adresa
            type: "GET",
            data: { query: searchQuery, page: page, sortBy: sortBy },
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
                                            <a href="#" class="btn btn-primary bg-dark">Add to Cart</a>
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

    // Vyhľadávanie
    $(".search-form").submit(function (event) {
        event.preventDefault();
        searchQuery = $("#search-input").val();
        page = 1;
        hasMoreData = true;
        $("#product-list").html(""); 
        loadProducts();
    });

    // Posunom na spodok sa načítajú ďalšie produkty
    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
            loadProducts();
        }
    });

    // Zmena triedenia (sortovania)
    $("#sort-select").change(function () {
        sortBy = $(this).val();  // Zmena hodnoty sortovania
        page = 1;  // Reset na prvú stránku
        hasMoreData = true;  // Nastavenie na True, aby sa načítavali ďalšie produkty
        $("#product-list").html("");  // Vyčistiť zoznam produktov
        loadProducts();  // Načítať produkty s novým zoradením
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