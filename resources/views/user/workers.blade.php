@extends('layouts.guest')

@section('title')
    {{ __('Car Services') }}
@endsection
@section('main')
    <style>
        .hero_in.tours:before {
            background-image: url('{{ asset($category->image) }}');
        }

    </style>

    <section class="hero_in tours">
        <div class="wrapper">
            <div class="container">
                <h1 class="fadeInUp"><span></span>{{ $category->{'name_'.app()->getLocale() } }}</h1>
            </div>
        </div>
    </section>

    <div class="container margin_60_35">
        <div class="row">
            <h3 style="text-align: center;width: 100%; margin-bottom: 40px">{{ __('Workers') }}</h3>
            <div class="col-lg-12">
                <div class="isotope-wrapper">
                    <div class="row" id="data_row">
                        @foreach ($category->workers as $worker)
                            <div class="col-md-6 isotope-item popular">
                                <a href="{{ route('worker_show', $worker->id) }}">
                                    <div class="box_grid">
                                        <h3>{{ $worker->first_name}}&nbsp;{{ $worker->last_name}}</h3>
                                        <p>{{ $worker->{'profession_'.app()->getLocale()} }}</p>
                                        <ul>
                                            <li>
                                                <i class="icon_clock_alt"></i> {{ substr($worker->working_hours_start, 0,-3) }}
                                                - {{substr($worker->working_hours_end,0,-3)}} </li>
                                            <li></li>
                                        </ul>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Range Slider -->
    <script>
        $(document).ready(function () {
            var timers = Array.from(document.getElementsByClassName("timer"));

            timers.forEach(function (timer) {
                var countDownDate = new Date(timer.getAttribute('data-time')).getTime();

                // Update the count down every 1 second
                var x = setInterval(function () {

                    // Get today's date and time
                    var now = new Date().getTime();

                    // Find the distance between now and the count down date
                    var distance = countDownDate - now;

                    // Time calculations for days, hours, minutes and seconds
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    // Display the result in the element with id="demo"
                    timer.innerHTML = days + "d " + hours + "h "
                        + minutes + "m " + seconds + "s ";

                    // If the count down is finished, write some text
                    if (distance < 0) {
                        clearInterval(x);
                        timer.innerHTML = "EXPIRED";
                    }
                }, 1000);
            })
        });
    </script>
@endsection