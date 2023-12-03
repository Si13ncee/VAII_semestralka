<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tech H4ven</title>
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="frontend/css/style_main.css" rel="stylesheet">
  
</head>
<body class="d-flex flex-column min-vh-100 bg-gray">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">{{ config('Tech H4ven', 'Tech H4ven') }}</a>
            
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>


                <div class="collapse navbar-collapse" id="navbarNav">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Catalogue</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Contact</a>
                        </li>
                        
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('login') ? 'active' : '' }}" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('register') ? 'active' : '' }}" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ Auth::user()->name }}
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                My profile  
                                            </a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }} 
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

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

      <!-- Add product category cards here -->
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
      <!-- Add more categories as needed -->
    </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="footer mt-5 py-3 bg-dark text-white noDeco">
    <div class="container text-center">
      <span>&copy; 2023 Tech H4ven
        <br><a href="http://www.freepik.com"> Background image designed by Freepik</a>
      </span>
    </div>
  </footer>

 <!-- Bootstrap JS and dependencies -->
 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>