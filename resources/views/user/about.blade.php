@extends('layouts.guest')

@section('title')
    {{ __('About us') }}
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <style>
        .hero_in.general::before {
            background-image: url('{{asset('images/car_wash.jpg')}}');
        }
    </style>
@endsection

@section('main')


    <section class="hero_in general">
        <div class="wrapper">
            <div class="container">
                <h1 class="fadeInUp"><span></span>{{ __('About us') }}</h1>
            </div>
        </div>
    </section>

    <div class="bg_color_1">
        <div class="container margin_80_55">
            <div class="main_title_2">
                <span><em></em></span>
                <h2>{{ __('Auto Services: Quality Car Services You Can Trust') }}</h2>
            </div>
            <div class="row justify-content-between">
                <div class="col-lg-12">{{ __('Welcome to Car Service, the place where you can find quality car services you can trust. We are a team of experienced and certified car mechanics who are passionate about providing the best care for your car. Whether you need a routine maintenance, a repair, or an emergency service, we are here to help you.') }}</div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('js/magnific-popup.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.carousel-item').each(function() {
                $(this).magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    gallery: {
                        enabled: true
                    }
                });
            });
        });
    </script>
@endsection
