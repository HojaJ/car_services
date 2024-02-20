@extends('layouts.guest')

@section('title') {{ __('Home') }} @endsection

@section('css')
    <link rel="preload" href="{{ asset('layerslider/css/layerslider.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('layerslider/css/layerslider.css') }}"></noscript>

    {{--<link  href="{{ asset('layerslider/css/layerslider.css') }}" rel="stylesheet">--}}
@endsection

@section('main')
    @if(count($services))
        <div id="full-slider-wrapper">
            <div id="layerslider" style="width:100%;height:550px;">
                @foreach ($services as $service)
                    <div class="ls-slide" data-ls="slidedelay: 5000; transition2d:85;">
                        <img src="{{ asset($service->image) }}" class="ls-bg" alt="{{ $service->{'name_'.app()->getLocale()} }}">
                        <h3 class="ls-l slide_typo" style="top: 47%; left: 50%;" data-ls="offsetxin:0;durationin:2000;delayin:1000;easingin:easeOutElastic;rotatexin:90;transformoriginin:50% bottom 0;offsetxout:0;rotatexout:90;transformoriginout:50% bottom 0;">{{ $service->{'name_'.app()->getLocale()} }}</h3>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="container margin_60_35">
            <div class="main_title_2">
                <span><em></em></span>
                <h2>{{ __('Our services') }}</h2>
            </div>

            <div class="row">
                @foreach ($services as $service)
                    <div class="col-md-6">
                        <a class="box_topic box_flex" href="{{ route('cat_show', $service->id) }}">
                            <div class="icon_wrapper">
                                <i class="pe-7s-car"></i>
                            </div>
                            <div class="title_wrapper">
                                <h3>{{ $service->{'name_'.app()->getLocale()} }}</h3>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif



@endsection

@section('js')
    <script src="{{ asset('js/index.js') }}"></script>

    <script>
        'use strict';
        $('#layerslider').layerSlider({
            autoStart: true,
            navButtons: false,
            navStartStop: false,
            showCircleTimer: false,
            responsive: true,
            responsiveUnder: 1280,
            layersContainer: 1200,
            skinsPath: 'layerslider/skins/'
        });
    </script>
@endsection