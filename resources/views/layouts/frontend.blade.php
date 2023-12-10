<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8" />
    <meta name="description" content="MEDNET HOMEPAGE" />
    <meta name="keywords" content="MEDNET, unica, creative, html" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>MEDNET | HOMEPAGE</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet" />

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/elegant-icons.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/slicknav.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" type="text/css" />
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        @guest
                        <div class="header__top__right">
                            <div class="header__top__right__language header__top__right__auth">
                                <a class="d-inline" href="{{ route('login') }}"><i class="fa fa-user"></i> Login</a>
                            </div>
                            <div class="header__top__right__auth">
                                <a href="{{ route('register') }}"><i class="fa fa-user"></i> Register</a>
                            </div>
                        </div>
                        @else
                        <div class="header__top__right">
                            <div class="header__top__right__language header__top__right__auth">
                                <a class="d-inline" href="#"><i class="fa fa-user"></i> {{ auth()->user()->username }}</a>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">Profile</a></li>
                                </ul>
                            </div>
                            <div class="header__top__right__auth">
                                <a href="#"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit()"><i
                                        class="fa fa-user"></i> Logout</a>
                                <form action="{{ route('logout') }}" id="logout-form" method="post">
                                    @csrf
                                </form>
                            </div>
                        </div>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="/"><img src="{{ asset('frontend/img/logo.png') }}" alt="" /></a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="/">Home</a></li>
                            <li><a href="{{ route('shop.index') }}">Shop</a></li>
                            <li>
                                <a href="#">Categories</a>
                                <ul class="header__menu__dropdown">
                                    @foreach($menu_categories as $menu_category)
                                    <li><a href="{{ route('shop.index', $menu_category->slug) }}">{{ $menu_category->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                            <li><a href="{{ route('reviews.index') }}">Reviews</a></li>
                            <li><a href="{{ route('reviews.create') }}">Write a Review</a></li>
                            <br></br>
                            <li><a href="{{ route('profile.index') }}">Profile</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 text-right">
                    <div class="header__cart">
                        <ul>
                            <li>
                                <a href="#"><i class="fa fa-heart"></i> <span>1</span></a>
                            </li>
                            <li>
                                <a href="{{ route('cart.index') }}"><i class="fa fa-shopping-bag"></i> <span>{{ $cartCount }}</span></a>
                            </li>
                        </ul>
                        <div class="header__cart__price">item: <span>${{ $cartTotal }}</span></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <input type="text" placeholder="What do yo u need?" />
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">  
                              <i class='fa fa-headphones' style='color: blue'></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>01XXXXXXXX</h5>
                                <span>We Provide Support 24/7</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    @yield('content')

    <script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('frontend/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
