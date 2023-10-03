@extends('layouts.users')

@section('page-styles')
    <link rel="stylesheet" href="{{ asset('css/user-inventory.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <style>
        .scrollable-row {
            max-height: 200px;
            overflow-y: auto;
        }

        .marquee-container {
            overflow: hidden;
            white-space: nowrap;
            width: 100%;
        }

        .marquee-content {
            display: inline-block;
            animation: marquee 15s linear infinite;
        }

        @keyframes marquee {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(-100%);
            }
        }
        .row
        {
            --bs-gutter-x: 0;
        }

    </style>

@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <img src="{{ asset('img/LOGO.png') }}" width="100%" alt="">
        </div>
    </div>
    <div class="row scrollable-row">
        <div class="col-12">
            <ul>
                @foreach ($ticketRequest as $tR)
                    <li>
                        {{ $tR['user']['name'] }} {{ $tR['content'] }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="box row mt-1 mb-3">
        <div class="col-12">
            <div class="marquee-container">
                <div class="marquee-content text-end">
                    @foreach ($marquees as $marquee)
                        <span>{{ $marquee['content'] }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 scrollable-row" style="max-height: 400px;">
            <h2>需求的機票</h2>
            <ul>
                @foreach ($tickets as $t)
                    <li>
                        <span>{{ $t['flight']['departure_location'] }} 到 {{ $t['flight']['destination'] }}</span>
                        <button class="transfer-button" data-ticket-url="{{ route('ticketRequirement.transfer', ['ticket_id' => $t['id'] ]) }}">轉讓</button>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

@endsection

@section('page-scripts')
    <script src="{{ asset('js/users/home.js') }}"></script>
@stop
