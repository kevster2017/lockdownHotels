<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Lockdown Hotels</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>





</head>

<body>
    <div class="app mb-3">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-md">
            <div class="container-fluid d-flex align-items-center">
                <div class="logo">
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        <img src="/images/LockdownHotels.png" alt="logo-image" style="height: 80px; width:100px" class="d-flex align-items-center">
                    </a>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @if(auth()->check())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/home') }}">Home</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Welcome</a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('myBookings') }}">My Bookings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('hotels.create') }}">List Your Property</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('myHotels') }}">My Properties</a>
                        </li>
                        @if(auth()->check())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('viewCart') }}">View Cart</a>
                        </li>
                        @endif
                        @if(auth()->check() && auth()->user()->isAdmin == 1)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact.index') }}">Messages</a>
                        </li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="btn btn-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="btn btn-outline-info" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 min-vh-100">
            @include('flashMessage')
            @yield('content')
        </main>
        <!-- Footer Navigation Bar -->

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container" style="color: #737373; padding-top: 15px;">
                <p>

                    <!--Footer Links-->
                    <a class="footerLink" href="{{ url('aboutUs') }}">About Us</a> |
                    <a class="footerLink" href="{{ route('contact.create') }}">Contact Us</a> |
                    <a class="footerLink" href="{{ url('siteMap') }}">Site Map</a> |
                    <a class="footerLink" href="{{ url('tsAndCs') }}">Terms and Conditions</a> |
                    <a class="footerLink" href="{{ url('privacyPolicy') }}">Privacy Policy</a>


                </p><br>


                <!--Copyright info-->
                <p>
                    <span>&#169;</span>Lockdown Hotels 2021 - {{ now()->year }}
                </p>
            </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>

</html>