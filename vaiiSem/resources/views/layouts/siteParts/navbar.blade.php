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
                    <a class="nav-link" href="{{ url('/catalogue') }}">Catalogue</a>
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
                            <li><a class="dropdown-item" href="{{ route('myOrders')}}">My Orders</a></li>
                            @if(Auth::user()->isAdmin())
                            <li><a class="dropdown-item" href="{{ route('dashboard') }}">Admin Dashboard</a></li>
                            @endif
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

                
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cart.show') }}" style="position: relative;">
                        <i class="bi bi-cart fs-5"></i>
                        <div class="cart-info" style="position: absolute; top: 0; right: 0; background-color: red; color: white; font-size: 10px; border-radius: 50%; width: 18px; height: 18px; text-align: center; line-height: 14px;">
                            @php
                                $cartItemCount = 0;
                                $totalPrice = 0;
                                
                                if (Auth::check()) {
                                    // Pre prihlásených používateľov
                                    $cartItems = Auth::user()->cartItems;
                                    $cartItemCount = $cartItems->sum('pocet');
                                    $totalPrice = $cartItems->sum(function($item) {
                                        return $item->pocet * $item->product->price;
                                    });
                                } else {
                                    // Pre neprihlásených používateľov (v session)
                                    $cart = session()->get('cart', []);
                                    $cartItemCount = array_sum(array_column($cart, 'pocet'));
                                    $totalPrice = array_sum(array_map(function($item) {
                                        return $item['price'] * $item['pocet'];
                                    }, $cart));
                                }
                            @endphp
                            {{ $cartItemCount }}
                        </div>
                        <div style="font-size: 12px; color: white;">
                            {{ number_format($totalPrice, 2) }} €
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
