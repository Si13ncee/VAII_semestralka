<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ asset('frontend/css/style_main.css') }}" rel="stylesheet">
  <link href="{{ asset('frontened/css/sidebar.css') }}" rel="stylesheet">
</head>


<body class="d-flex flex-column min-vh-100 bg-gray">
<div class="wrapper">
        @include('layouts.siteParts.navbar')
    </div>  


<main class="d-flex align-items-stretch">
        <div class="wrapper bg-dark sidebar">
            @include('layouts.siteParts.adminOnly.sidebar')
        </div>  
    
        <div class="col content content-bg"> 
            @yield('content')
        </div>
    </div>
    
  </main>

  <div class="wrapper">
        @include('layouts.siteParts.footer')
    </div>  
    

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  @yield('scripts')
</body>
</html>
