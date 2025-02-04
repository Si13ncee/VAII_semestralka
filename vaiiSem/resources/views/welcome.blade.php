<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tech H4ven</title>
  
  <!-- Bootstrap CSS -->
  <!-- Styles -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="frontend/css/style_main.css" rel="stylesheet">
  
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

  <!-- Product Categories -->
  <main class="container mt-4">
    <h2>Explore Our Categories</h2>

    <!-- 1st row of cards -->
    <div class="row">

      <div class="col-md-4 mb-4">
        <a href="#" class="card d-flex flex-column justify-content-between">
          <div class="card-body">
            <h5 class="card-title">Smartphones</h5>
            <p class="card-text">Explore the newest products from our Smarthphone category.</p>
          </div>
        </a>
      </div>

      <div class="col-md-4 mb-4">
        <a href="#" class="card d-flex flex-column justify-content-between">
          <div class="card-body">
            <h5 class="card-title">Computers</h5>
            <p class="card-text">Take a look through the most powerful pieces that we have to offer!</p>
          </div>
        </a>
      </div>

      <div class="col-md-4 mb-4">
        <a href="#" class="card d-flex flex-column justify-content-between">
          <div class="card-body">
            <h5 class="card-title">Computer Accessories</h5>
            <p class="card-text">Find accessories for your devices.</p>
          </div>
        </a>
      </div>
    </div>

    <!-- 2nd row of cards -->
    <div class="row">
      <div class="col-md-4 mb-4">
        <a href="#" class="card d-flex flex-column justify-content-between">
          <div class="card-body">
            <h5 class="card-title">Accessories</h5>
            <p class="card-text">Find accessories for your devices.</p>
          </div>
        </a>
      </div>

      <div class="col-md-4 mb-4">
        <a href="#" class="card d-flex flex-column justify-content-between">
          <div class="card-body">
            <h5 class="card-title">Accessories</h5>
            <p class="card-text">Find accessories for your devices.</p>
          </div>
        </a>
      </div>
    </div>
    </div>
  </main>

  <div class="wrapper">
        @include('layouts.siteParts.footer')
    </div>  


 <!-- Bootstrap JS and dependencies -->
 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>