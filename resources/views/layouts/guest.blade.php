<!DOCTYPE html>
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Oguztravel - have fun and enjoy">
    <meta name="author" content="subo">

    <title>Car Services</title>

    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon" />


    {{--  <link href="{{ asset('css/all.css') }}" rel="stylesheet">--}}

    <link rel="preload" href="{{ asset('css/bootstrap.min.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"></noscript>

    <link rel="preload" href="{{ asset('css/vendors.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('css/vendors.css') }}"></noscript>

    <link rel="preload" href="{{ asset('css/style.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><li   nk rel="stylesheet" href="{{ asset('css/style.css') }}"></noscript>
    @yield('css')
</head>


<body>
@yield('messages')
<div id="page" class="theia-exception">

    <header class="header menu_fixed">
        <div id="preloader">
            <div data-loader="circle-side"></div>
        </div>
        <div id="logo">
            <a href="{{ route('index') }}">
                <img src="{{ asset('img/logo_1.png') }}" height="36" alt="logo" class="logo_normal">
                <img src="{{ asset('img/logo.png') }}" height="36" alt="logo-sticky" class="logo_sticky">
            </a>
        </div>
        <a href="#menu" class="btn_mobile">
            <div class="hamburger hamburger--spin" id="hamburger">
                <div class="hamburger-box">
                    <div class="hamburger-inner"></div>
                </div>
            </div>
        </a>
        <nav id="menu" class="main-menu">
            <ul>
                <li> <span><a href="{{ route('index') }}">{{ __('Home') }}</a></span></li>
                <li><span><a href="{{ route('about') }}">{{ __('About us') }}</a></span></li>
                <li><span><a href="{{ route('contact') }}">{{ __('Contact us') }}</a></span></li>

                @include('layouts.language')

                @if (Auth::guest())
                <li class="ml-5"><span><a href="{{ route('login') }}">{{ __('Login') }}</a></span></li>
                @else
                <li class="ml-5"><span><a href="{{ route('logout') }}">{{ __('Log Out') }}</a></span></li>
                @endif
            </ul>
        </nav>
    </header>
    <main>
        @yield('main')
    </main>

    <footer>
        <div class="container margin_60_35">
            <div class="row">
                <div class="col-lg-5 col-md-12 p-r-5">
                    <p><img src="{{ asset('img/logo_1.png') }}" height="36" alt="logo-footer"></p>
                    <div class="follow_us">
                        <ul>
                            <li>{{ __('Follow us') }}</li>
                            <li><a href="#0"><i class="ti-facebook"></i></a></li>
                            <li><a href="#0"><i class="ti-twitter-alt"></i></a></li>
                            <li><a href="#0"><i class="ti-google"></i></a></li>
                            <li><a href="#0"><i class="ti-pinterest"></i></a></li>
                            <li><a href="#0"><i class="ti-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 ml-lg-auto">
                    <h5>{{ __('Useful links') }}</h5>
                    <ul class="links">
                        <li><a href="{{ route('about') }}">{{ __('About us') }}</a></li>
                        <li><a href="{{ route('contact') }}">{{ __('Contact us') }}</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5>{{ __('Contact us') }}</h5>
                    <ul class="contacts">
                        <li><a href="tel://65555555"><i class="ti-mobile"></i> + 63 555555</a></li>
                        <li><a href="mailto:"><i class="ti-email"></i> support@.carsericescom</a></li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-6"></div>
                <div class="col-lg-6">
                    <ul id="additional_links">
                        <span>Copyright &copy; Car Services 2024</span>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</div>

<div id="toTop"></div>

<script src="{{ asset('js/common_scripts.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
@yield('js')
</body>
</html>