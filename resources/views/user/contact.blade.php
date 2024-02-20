@extends('layouts.guest')

@section('title')
    {{ __('Contact us') }}
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/intlTelInput.min.css') }}">
    <style>
        .hide {
            display: none;
        }

        .iti.iti--allow-dropdown.iti--separate-dial-code {
            width: 100%
        }
         .hero_in.contacts:before {
             background-image: url('{{ asset('images/car_repair.jpg') }}');
         }

    </style>
@endsection

@section('main')

    <section class="hero_in contacts">
        <div class="wrapper">
            <div class="container">
                <h1 class="fadeInUp"><span></span>{{ __('Contact us') }}</h1>
            </div>
        </div>
    </section>

    <div class="bg_color_1">
        <div class="container margin_80_55">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="map" id="map">
                        <img src="{{ asset('images/map.png') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <h4 class="mb-4">{{ __('Send a message') }}</h4>
                    <div id="message-contact"></div>

                    <form method="post" action="" id="contactform" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{ __('First Name') }}</label>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text" id="name"  name="name" value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
                                    @else
                                        <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="surname">{{ __('Last Name') }}</label>
                                    <input class="form-control @error('surname') is-invalid @enderror" type="text" id="surname" name="surname" value="{{ old('surname') }}" required>
                                    @if ($errors->has('surname'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('surname') }}</strong></span>
                                    @else
                                        <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">{{ __('Email') }}</label>
                                    <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>
                                    @else
                                        <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">{{ __('Phone') }}</label>
                                    <input class="form-control @error('phone') is-invalid @enderror" type="tel" id="phone" name="phone" value="{{ old('phone') }}" required>
                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('phone') }}</strong></span>
                                    @else
                                        <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                                    @endif
                                    <span id="valid-msg" class="hide">Valid</span>
                                    <span id="error-msg" class="hide"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message">{{ __('Message') }}</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" style="height:150px;" required>{{ old('message') }}</textarea>
                            @if ($errors->has('message'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('message') }}</strong></span>
                            @else
                                <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                            @endif
                        </div>
                        <p class="add_top_30">
                            <button class="btn_1 rounded" id="submit-contact" type="submit">{{ __('Send') }}</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection