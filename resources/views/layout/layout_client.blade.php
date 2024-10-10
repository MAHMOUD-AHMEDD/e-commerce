<html>
<head>
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/contact">contact</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/profile">profile</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/notifications">notifications</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/productss/favourite">Favourite</a>
            </li>
            <li class="nav-item dropdown">
                <div class="btn-group">
                    <a class="nav-link btn-sm" type="button" href="/products">
                        Products
                    </a>
                    <button type="button" class="btn-sm nav-link dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                        @foreach($categories as $category)
                            <li><a class="dropdown-item" href="{{url('products/category/'.$category->id)}}">{{$category->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{asset('/orders/'.auth()->id())}}">orders</a>
            </li>
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="/auth/login">login</a>
                </li>
            @endguest
            @auth
                <li class="nav-item">
                    <a class="nav-link" href="/logout">logout</a>
                </li>
            @endauth
        </ul>
    </div>
</nav>
<div class="content">
    @yield('content')
</div>
<footer>Footer</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
{{--<script src="https://cdn.tailwindcss.com" ></script>--}}

<script src="{{asset('js/script.js')}}"></script>
