<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/elegant-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-flaticon@5.15.0/css/font-flaticon.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-flaticon/css/font-flaticon.css">

</head>
<body>
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>

    <!-- Offcanvas Menu Section Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="canvas-open">

        <i class="icon_menu"></i>
    </div>

    <div class="offcanvas-menu-wrapper" >
        <div class="logo" style="display: flex; padding: 20px; justify-content: space-between;">
            <a href="./index.html">
                <img src="img/logo.png" alt="">
            </a>

            <div class="search-icon  search-switch" style="padding-top: 5px;">
                <ul class="dropdown">
                  @auth
                  <li><a href="#">Profile</a></li>
                  <li><a href="#">Logout</a> </li>
                  @else
                  <li><a href="#">Login</a></li>
                  @endauth
                </ul>
            </div>
        </div>



        <nav class="mainmenu mobile-menu">
            <ul>
                <li class="active"><a href="{{route('home')}}">Home</a></li>
                <li><a href="{{url('/store')}}">Rooms</a></li>
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="#">Pages</a>
                    <ul class="dropdown">
                        @php
                          $categories = \App\Models\Category::all();
                        @endphp
                            @foreach ($categories as $category)
                        <li style="color: {{ $category->text }}" ><a href="{{ url('/category/' . $category->id) }}">  {{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li><a href="./contact.html">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>

    </div>


    <!-- Header Section Begin -->
    <header class="header-section">

        <div class="menu-item">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="logo">
                            <a href="./index.html">
                                <img src="img/logo.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="nav-menu">
                            <nav class="mainmenu">
                                <ul>
                                    <li class="active"><a href="{{route('home')}}">Home</a></li>
                                    <li><a href="{{url('/store')}}">Rooms</a></li>
                                    <li><a href="{{route('about')  }}">About Us</a></li>
                                    <li><a href="#">Pages</a>
                                        <ul class="dropdown">
                                                @foreach ($categories as $category)
                                            <li style="color: {{ $category->text }}"><a href="{{ url('/category/' . $category->id) }}">  {{ $category->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li><a href="{{url('/contact')}}">Contact</a></li>
                                </ul>
                            </nav>
                <div class="mainmenu"> <ul class="dropdown">
                    @auth
                    <li><a href="#">Profile</a></li>
                    <li><a href="#">Logout</a> </li>
                    @else
                    <li><a href="#">Login</a></li>
                    @endauth
                </ul></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->
