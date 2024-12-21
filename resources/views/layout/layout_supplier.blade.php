<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Remix Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet"/>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg" style="background-color: #1c2331;">
    <div class="container">
        <a class="navbar-brand fw-bold text-light" href="{{ route('home') }}">E-Shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="/contact">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/profile">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/notifications">Notifications</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/productss/favourite">Favourites</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/products/create">Create Product</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Products</a>
                    <ul class="dropdown-menu">
                        @foreach($categories as $category)
                            <li>
                                <a class="dropdown-item" href="{{ url('products/category/' . $category->id) }}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ asset('/orders/' . auth()->id()) }}">Orders</a>
                </li>
                @guest
                    <li class="nav-item">
                        <a class="btn btn-outline-light btn-sm" href="/auth/login">Login</a>
                    </li>
                @endguest
                @auth
                    <li class="nav-item">
                        <a class="text-light btn btn-danger" style="margin: 5px;" href="/logout">Logout</a>
                    </li>
                @endauth
                <li class="nav-item">
                    <form class="d-flex ms-2" action="/search" method="GET">
                        <input class="form-control form-control-sm" type="search" name="query" placeholder="Search products..." aria-label="Search">
                        <button class="btn btn-light btn-sm ms-1" type="submit"><i class="ri-search-line"></i></button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Content Section -->
<div class="content">
    @yield('content')
</div>

<!-- Footer -->
<footer class="text-center text-lg-start text-white" style="background-color: #1c2331; padding-top: 30px;">
    <!-- Section: Links -->
    <section class="">
        <div class="container text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold">Company name</h6>
                    <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                </div>
                <!-- Grid column -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold">Products</h6>
                    <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                    <p><a href="#!" class="text-white">MDBootstrap</a></p>
                    <p><a href="#!" class="text-white">MDWordPress</a></p>
                    <p><a href="#!" class="text-white">BrandFlow</a></p>
                    <p><a href="#!" class="text-white">Bootstrap Angular</a></p>
                </div>
                <!-- Grid column -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold">Useful links</h6>
                    <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                    <p><a href="#!" class="text-white">Your Account</a></p>
                    <p><a href="#!" class="text-white">Become an Affiliate</a></p>
                    <p><a href="#!" class="text-white">Shipping Rates</a></p>
                    <p><a href="#!" class="text-white">Help</a></p>
                </div>
                <!-- Grid column -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <h6 class="text-uppercase fw-bold">Contact</h6>
                    <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                    <p><i class="fas fa-home mr-3"></i> New York, NY 10012, US</p>
                    <p><i class="fas fa-envelope mr-3"></i> info@example.com</p>
                    <p><i class="fas fa-phone mr-3"></i> +01 234 567 88</p>
                    <p><i class="fas fa-print mr-3"></i> +01 234 567 89</p>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
    </section>
    <!-- Section: Links -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © {{ date('Y') }} Your Company Name. All Rights Reserved.
    </div>
    <!-- Copyright -->
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
