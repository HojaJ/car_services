@extends('layouts.app')
@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('js/main.css') }}">
        <link rel="stylesheet" href="{{ asset('js/daygrid.css') }}">
        <link rel="stylesheet" href="{{ asset('js/timegrid.css') }}">
    @endpush

    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-center mb-4">
                <h2>{{ $worker->first_name }} {{ $worker->last_name }}</h2>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div id="calendar" style="width: 55%;"></div>
            </div>
        </div>

    </div>

    @push('scripts')
        <script src="{{ asset('js/fullcalendar.min.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'timeGridWeek',
                    allDaySlot: false,
                    slotMinTime: "{{ $worker->working_hours_start }}",
                    slotMaxTime: "{{ $worker->working_hours_end }}",
                    headerToolbar: {
                        left: 'prev,next',
                        center: 'title',
                        right: 'timeGridWeek,timeGridDay' // user can switch between the two
                    },
                    events: @json($events),
                });
                calendar.render();
            });
        </script>
    @endpush
@endsection