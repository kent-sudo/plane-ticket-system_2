@extends('layouts.users')

@section('page-styles')
    <link rel="stylesheet" href="{{ asset('css/user-inventory.css') }}">
@endsection

@section('content')
    <img src="{{ asset('img/我的票倉.png') }}" width="100%" alt="">
    <div class="list-container">
        <ul>
            @foreach ($tickets as $t)
                <li>
                    <span>機票 : {{ $t['flight']['departure_location'] }} 到 {{ $t['flight']['destination'] }}</span>
                    <div class="button_section">
                        <button class="details-btn" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flightDetails{{ $t['id'] }}" aria-expanded="false"
                            aria-controls="flightDetails{{ $t['id'] }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                                <path
                                    d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                            </svg>
                        </button>
                        <button class="transfer-button"
                            data-ticket-url="{{ route('inventory.transfer', ['ticket_id' => $t['id']]) }}">轉讓</button>
                    </div>
                </li>
                <!-- DetailsBox -->
                <div class="collapse" id="flightDetails{{ $t['id'] }}">
                    <div class="card card-body mb-3">
                        <h5>機票詳細資訊</h5>
                        <ul class="overflow-auto h-50 w-100 bg-white">
                            <li>票价：${{ $t->price }}</li>
                            <li>航班編號: {{ $t['flight']['flight_number'] }}</li>
                            <li>起飛時間: {{ $t['flight']['departure_time'] }}</li>
                            <li>到達時間: {{ $t['flight']['arrival_time'] }}</li>
                            <li>起飛地點: {{ $t['flight']['departure_location'] }}</li>
                            <li>目的地: {{ $t['flight']['destination'] }}</li>
                            <li>座位號碼: {{ $t['seat_number'] }}</li>
                            <!-- 其他相關機票資訊 -->
                        </ul>
                    </div>
                </div>
            @endforeach


        </ul>
    </div>

@endsection

@section('page-scripts')
    <script>
        $('.details-btn').click(function() {
            $(this).toggleClass('active');
        });
    </script>
    <script src="{{ asset('js/users/home.js') }}"></script>
@stop
