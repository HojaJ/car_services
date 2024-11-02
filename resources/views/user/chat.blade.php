@extends('layouts.guest')

@section('title')
    {{ __('Ask me') }}
@endsection

@section('css')
    <style>
        .hero_in.general::before {
            background-image: url('{{asset('images/car_wash.jpg')}}');
        }
    </style>
    <style>

        .chat {
            margin-bottom: 3rem;
            font-weight: var(--bs-body-font-weight);
            line-height: var(--bs-body-line-height);
            text-align: var(--bs-body-text-align);
            font-family: "Nunito", sans-serif;
            font-size: 1rem;
            color: #161c2d;
            box-sizing: border-box;
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            height: var(--bs-card-height);
            word-wrap: break-word;
            background-clip: initial;
            border: 1px solid #1a1b1c26 !important;
            margin-top: 1.5rem !important;
            background-color: #fff;
            box-shadow: 0px 0px 3px #1a1b1c26 !important;
            border-radius: 6px !important;
        }
        .chat .top {
            display: block;
            font-weight: var(--bs-body-font-weight);
            line-height: var(--bs-body-line-height);
            text-align: var(--bs-body-text-align);
            font-family: "Nunito", sans-serif;
            font-size: 1rem;
            color: #161c2d;
            word-wrap: break-word;
            box-sizing: border-box;
            border-bottom: var(--bs-border-width) var(--bs-border-style) var(--bs-border-color) !important;
            justify-content: space-between !important;
            padding: 1.5rem !important;
        }
        .chat .top img {
            display: inline-block;
            border: var(--bs-border-width) var(--bs-border-style) var(--bs-border-color) !important;
            border-radius: 50% !important;
            box-shadow: 0 0 3px rgba(60, 72, 88, 0.15) !important;
        }
        .chat .top div {
            vertical-align: middle;
            display: inline-block;
            font-weight: var(--bs-body-font-weight);
            line-height: var(--bs-body-line-height);
            text-align: var(--bs-body-text-align);
            font-family: "Nunito", sans-serif;
            font-size: 1rem;
            color: #161c2d;
            word-wrap: break-word;
            box-sizing: border-box;
            overflow: hidden !important;
            margin-left: 1rem !important;
        }
        .chat .top div p {
            display: block;
            text-align: var(--bs-body-text-align);
            word-wrap: break-word;
            box-sizing: border-box;
            text-decoration: none !important;
            transition: all 0.5s ease;
            font-size: 1rem;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: #3c4858 !important;
            font-family: var(--bs-font-sans-serif);
            line-height: 1.4;
            font-weight: 600;
        }
        .chat .top div small, .chat .top div .small {
            display: block;
            font-weight: var(--bs-body-font-weight);
            line-height: var(--bs-body-line-height);
            text-align: var(--bs-body-text-align);
            font-family: "Nunito", sans-serif;
            word-wrap: break-word;
            box-sizing: border-box;
            font-size: 0.875em;
            color: #6c757d !important;
        }
        .chat .messages {
            font-weight: var(--bs-body-font-weight);
            line-height: var(--bs-body-line-height);
            text-align: var(--bs-body-text-align);
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            font-family: "Nunito", sans-serif;
            font-size: 1rem;
            color: #161c2d;
            word-wrap: break-word;
            box-sizing: border-box;
            list-style: none;
            margin-bottom: 0 !important;
            padding: 1rem !important;
        }
        .chat .messages .left {
            text-align: left;
        }
        .chat .messages .right {
            text-align: right;
        }
        .chat .messages .message {
            margin-bottom: 1rem;
        }
        .chat .messages .message p {
            display: inline-flex;
            font-weight: var(--bs-body-font-weight);
            line-height: var(--bs-body-line-height);
            text-align: var(--bs-body-text-align);
            font-family: "Nunito", sans-serif;
            word-wrap: break-word;
            list-style: none;
            box-sizing: border-box;
            font-size: 0.875em;
            margin: 0.25rem;
            padding: 0.5rem 1rem !important;
            color: #6c757d !important;
            background-color: rgba(var(--bs-light-rgb), 1) !important;
            border-radius: var(--bs-border-radius) !important;
        }
        .chat .messages .message img {
            display: inline-flex;
            margin: 0.25rem;
            font-weight: var(--bs-body-font-weight);
            line-height: var(--bs-body-line-height);
            text-align: var(--bs-body-text-align);
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            font-family: "Nunito", sans-serif;
            font-size: 1rem;
            color: #161c2d;
            word-wrap: break-word;
            box-sizing: border-box;
            vertical-align: middle;
            border: var(--bs-border-width) var(--bs-border-style) var(--bs-border-color) !important;
            border-radius: 50% !important;
            box-shadow: 0 0 3px rgba(60, 72, 88, 0.15) !important;
            height: 45px;
            width: 45px;
        }
        .chat .bottom {
            font-weight: var(--bs-body-font-weight);
            line-height: var(--bs-body-line-height);
            text-align: var(--bs-body-text-align);
            font-family: "Nunito", sans-serif;
            font-size: 1rem;
            color: #161c2d;
            word-wrap: break-word;
            box-sizing: border-box;
            padding: 1rem 0 !important;
            border-top: var(--bs-border-width) var(--bs-border-style) var(--bs-border-color) !important;
        }
        .chat .bottom form{
            display: flex;
            justify-content: space-around;
        }
        .chat .bottom input {
            float: left;
            display: inline-flex;
            word-wrap: break-word;
            box-sizing: border-box;
            width: 90%;
            padding: 0.375rem 0.75rem;
            font-weight: 400;
            background-color: #fff;
            background-clip: padding-box;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            border: 1px solid #e9ecef;
            font-size: 14px;
            line-height: 26px;
            border-radius: 6px;
            color: #3c4858 !important;
        }
        .chat .bottom button {
            float: right;
            display: inline-flex;
            text-align: center;
            cursor: pointer;
            border: 1px solid #484848;
            border-radius: 5px;
            margin: 3px;
            width: 2.35rem;
            height: 2.35rem;
            background: url("/paper-plane-regular.svg") center no-repeat;
        }
    </style>

@endsection

@section('main')


    <section class="hero_in general">
        <div class="wrapper">
            <div class="container">
                <h1 class="fadeInUp"><span></span>{{ __('Ask me') }}</h1>
            </div>
        </div>
    </section>

    <div class="bg_color_1">
        <div class="container margin_80_55" style="max-width: 850px">
            <div class="chat">

                <!-- Header -->
                <div class="top">
                    <img width="70px;" src="{{ asset('img/chat_bot.png') }}" alt="Avatar">
                    <div>
                        <p style="margin-bottom: 10px">Carvana</p>
                        <small>Online</small>
                    </div>
                </div>
                <!-- End Header -->

                <!-- Chat -->
                <div class="messages">
                    <div class="left message" style="padding: 0">
{{--                        <img src="{{ asset('img/chat_bot.png') }}" alt="Avatar">--}}
{{--                        <p>Start chatting with Chat GPT AI below!!</p>--}}
                    </div>
                </div>
                <!-- End Chat -->

                <!-- Footer -->
                <div class="bottom">
                    <form>
                        <input type="text" id="message" name="message" placeholder="Enter message..." autocomplete="off">
                        <button type="submit"></button>
                    </form>
                </div>
                <!-- End Footer -->

            </div>

        </div>
    </div>

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $("form").submit(function (event) {
                event.preventDefault();
                let chat_img = "{{ asset('img/chat_bot.png') }}";
                let person_img = "{{ asset('img/person.png') }}";

                //Stop empty messages
                if ($("form #message").val().trim() === '') {
                    return;
                }

                //Disable form
                $("form #message").prop('disabled', true);
                $("form button").prop('disabled', true);

                $.ajax({
                    url: "/chat",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    },
                    data: {
                        "content": $("form #message").val()
                    }
                }).done(function (res) {

                    //Populate sending message
                    $(".messages > .message").last().after('<div class="right message">' +
                        '<p>' + $("form #message").val() + '</p>' +
                        '<img src="'+ person_img +'" alt="Avatar">' +
                        '</div>');

                    //Populate receiving message
                    $(".messages > .message").last().after('<div class="left message">' +
                        '<img src="'+ chat_img +'" alt="Avatar">' +
                        '<p>' + res + '</p>' +
                        '</div>');

                    //Cleanup
                    $("form #message").val('');
                    // $(document).scrollTop($(document).height());

                    //Enable form
                    $("form #message").prop('disabled', false);
                    $("form button").prop('disabled', false);
                });
            });

        });
    </script>
@endsection
