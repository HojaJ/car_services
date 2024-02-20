@extends('layouts.guest')

@section('title')
    {{ __('Car Services') }}
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/jquery-datetime-picker/jquery.datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/main.css') }}">
    <link rel="stylesheet" href="{{ asset('js/daygrid.css') }}">
    <link rel="stylesheet" href="{{ asset('js/timegrid.css') }}">
    <style>
        .hero_in.tours:before {
            background-image: url('{{ asset($worker->category->image) }}');
        }

    </style>

@endsection
@section('main')
    <section class="hero_in tours">
        <div class="wrapper">
            <div class="container">
                <h1><span></span>{{ $worker->first_name }}&nbsp;&nbsp;{{ $worker->last_name }}</h1>
                <h4 style="color: white">{{ $worker->{'profession_' . app()->getLocale()} }}</h4>
            </div>
        </div>
    </section>

    <div class="container margin_60_35">
        <div class="row ">
            <div class="col-lg-8">
                <div id="calendar" style="width: 100%;"></div>
            </div>

            <div class="col-lg-4">
                <div class="box_detail booking tour">

                    <form method="post" action="{{ route('request_post') }}" autocomplete="off">
                        @csrf
                        <input type="hidden" name="worker_id" value="{{ $worker->id }}">


                        <div class="form-group">
                            <label for="note">{{ __('Start Time') }}</label>
                            <input class="datetimepicker form-control" type="text" name="start_time">
                        </div>


                        <div class="form-group">
                            <label for="note">{{ __('Finish Time') }}</label>
                            <input class="datetimepicker form-control" type="text" name="finish_time">
                        </div>


                        <div class="form-group">
                            <label for="note">{{ __('Note') }}</label>
                            <textarea name="note" id="note"
                                      class="form-control">{{ old('note') }}</textarea>
                        </div>


                        <button class="btn_1 full-width purchase">{{ __("Send request") }}</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-datetime-picker/jquery.datetimepicker.full.min.js') }}"></script>
    <script>
        jQuery('.datetimepicker').datetimepicker({
            format:'d.m.Y H:i',
            minTime:'{{ $worker->working_hours_start }}',
            maxTime:'{{ $worker->working_hours_end }}',
            minDate:0,
            maxDate:'+1970/01/07',
            step:60,
            validateOnBlur: false,
        });

        const d = new Date();
        let day = d.getDay();
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                firstDay: day,

                allDaySlot: false,
                slotMinTime: "{{ $worker->working_hours_start }}",
                slotMaxTime: "{{ $worker->working_hours_end }}",
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'timeGridWeek' // user can switch between the two
                },
                events: @json($events),
            });
            calendar.render();
        });
    </script>
@endsection

