<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
        <span class="fs-4">Home</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ url('dashboard') }}" class="nav-link{{ Request::is('dashboard') ? ' active' : '' }}" aria-current="page">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ url('add-product') }}" class="nav-link{{ Request::is('add-product') ? ' active' : '' }}" aria-current="page">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                Add Products
            </a>
        </li>
        <li>
            <a href="{{ url('products') }}" class="nav-link{{ Request::is('products') ? ' active' : '' }}" aria-current="page">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                Products
            </a>
        </li>
        <li>
            <a href="{{ url('orders') }}" class="nav-link{{ Request::is('orders') ? ' active' : '' }} nav-link{{ Request::is('*viewOrder*') ? ' active' : '' }}" aria-current="page">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                Orders
            </a>
        </li>
    </ul>
    <hr>
</div>
