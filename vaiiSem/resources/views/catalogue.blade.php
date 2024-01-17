<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tech H4ven</title>
  
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

  <!-- Search bar -->
  <div class="container mt-4 text-center">
        <form class="form-inline justify-content-center">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-primary my-2 my-sm-0 custom-btn-outline" type="submit">Search</button>
        </form>
      </div>

       <!-- Tags container -->
      <div class="container mt-3">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="tags">
              <div class="tags-body">
                <button class="btn btn-secondary tag-btn">
                  <i class="far fa-square"></i>
                  Laptops
                </button>
                <button class="btn btn-secondary tag-btn">
                  <i class="far fa-square"></i>
                  Smartphones
                </button>
                <button class="btn btn-secondary tag-btn">
                  <i class="far fa-square"></i>
                  Gadgets
                </button>
                <button class="btn btn-secondary tag-btn">
                    <i class="far fa-square"></i>
                    PH1
                  </button>
                  <button class="btn btn-secondary tag-btn">
                    <i class="far fa-square"></i>
                    PH2
                  </button>
                  <button class="btn btn-secondary tag-btn">
                    <i class="far fa-square"></i>
                    PH3
                  </button>
                <!-- Add more tags as needed -->
              </div>
            </div>
          </div>
        </div>
      </div>
    
  <!-- Product Catalogue -->
  <main class="container mt-4 noDeco">
    <h2>Product Catalogue</h2>
  </main>

  <div class="wrapper">
        @include('layouts.siteParts.footer')
    </div>  


  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>