@extends('layouts.backend')

<!--  Body Wrapper -->
<!--  Header End -->
@section('content')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">轉讓機票</h5>
                <!--<p class="mb-0">This is a sample page </p>-->
                <form action="{{route('transfer_search')}}">
                    <div class="input-group mb-3">
                        <input name="keyword" type="text" class="form-control" placeholder="航班編號" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">查找</button>
                    </div>
                </form>
            </div>
            <ol class="list-group list-group-numbered">
                @foreach ($flights as $flight)
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <p>
                                <a class="fw-bold" data-bs-toggle="collapse" href="#collapseExample{{ $flight->id }}" role="button" aria-expanded="false" aria-controls="collapseExample{{ $flight->id }}">
                                    航班編號 {{$flight->flight_number}}
                                </a>
                            </p>
                            @foreach ($flight->tickets as $ticket)
                                <div class="collapse" id="collapseExample{{ $flight->id }}">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="card card-body">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item"></li>
                                                    <li  class="list-group-item">票价：{{$ticket->price}}</li>
                                                    <li  class="list-group-item">起飛時間：{{$ticket->flight->departure_time}}</li>
                                                    <li  class="list-group-item">到達時間：{{$ticket->flight->arrival_time}}</li>
                                                    <li  class="list-group-item">起飛地点：{{$ticket->flight->destination}}</li>
                                                    <li  class="list-group-item">到達地点：{{$ticket->flight->departure_location}}</li>
                                                    <li  class="list-group-item">座位号：{{$ticket->seat_number}}</li>
                                                    <li  class="list-group-item">订单号：{{$ticket->id}}</li>
                                                    <li  class="list-group-item">擁有著編號：{{$ticket->holder_id}}</li>
                                                    <select class="form-select" aria-label="Default select example" name="status" disabled="disabled">
                                                        <option value="0" {{ $ticket->status == 0 ? 'selected' : '' }}>已起飛</option>
                                                        <option value="1" {{ $ticket->status == 1 ? 'selected' : '' }}>未起飛</option>
                                                        <option value="2" {{ $ticket->status == 2 ? 'selected' : '' }}>延遲</option>
                                                        <option value="3" {{ $ticket->status == 3 ? 'selected' : '' }}>其他</option>
                                                    </select>
                                                    <br>
                                                    <form  method="post" action="{{route('transfer_transfer',['id' => $ticket->id])}}">
                                                        @csrf
                                                        @method('PUT')
                                                        <li  class="list-group-item">
                                                            <label for="holder_id" class="">轉讓給</label>
                                                            <div class="col-sm-10">
                                                                <input name="holder_id" type="number" class="form-control" id="holder_id" placeholder="用戶 ID">
                                                            </div>
                                                        </li>
                                                        <input type="submit" class="btn btn-primary" value="轉讓">
                                                    </form>
                                                </ul>
                                                <br>
                                                <!-- <a href="#" class="btn btn-primary">Go somewhere</a>-->
                                                <br>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </li>
                @endforeach
                    @foreach ($flightsWithoutHolders as $flight)
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <p>
                                    <a class="fw-bold" data-bs-toggle="collapse" href="#collapseExample{{ $flight->id }}a" role="button" aria-expanded="false" aria-controls="collapseExample{{ $flight->id }}">
                                        航班編號 {{$flight->flight_number}} (空機票)
                                    </a>
                                </p>
                                @php
                                    $ticketCounts = [];
                                    $duplicateTicketCount = 0;
                                @endphp
                                @foreach ($flight->tickets as $ticket)
                                    @php
                                        $ticketData = [
                                            'flight_id' => $ticket->flight_id,
                                            'price' => $ticket->price,
                                            'holder_id' => $ticket->holder_id,
                                            'status' => $ticket->status,
                                        ];

                                        $ticketDataKey = serialize($ticketData);

                                        if (!isset($ticketCounts[$ticketDataKey])) {
                                            $ticketCounts[$ticketDataKey] = 0;
                                        }

                                        $ticketCounts[$ticketDataKey]++;
                                        $duplicateTicketCount++;
                                    @endphp

                                    @if ($ticketCounts[$ticketDataKey] == 1)
                                        <div class="collapse" id="collapseExample{{ $flight->id }}a">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="card card-body">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item"></li>
                                                            <li class="list-group-item">票价：{{$ticket->price}}</li>
                                                            <li class="list-group-item">起飛時間：{{$ticket->flight->departure_time}}</li>
                                                            <li class="list-group-item">到達時間：{{$ticket->flight->arrival_time}}</li>
                                                            <li class="list-group-item">起飛地点：{{$ticket->flight->destination}}</li>
                                                            <li class="list-group-item">到達地点：{{$ticket->flight->departure_location}}</li>
                                                            <select class="form-select" aria-label="Default select example" name="status" disabled="disabled">
                                                                <option value="0" {{ $ticket->status == 0 ? 'selected' : '' }}>已起飛</option>
                                                                <option value="1" {{ $ticket->status == 1 ? 'selected' : '' }}>未起飛</option>
                                                                <option value="2" {{ $ticket->status == 2 ? 'selected' : '' }}>延遲</option>
                                                                <option value="3" {{ $ticket->status == 3 ? 'selected' : '' }}>其他</option>
                                                            </select>
                                                            <br>
                                                            <form method="post" action="{{route('transfer_many_transfer',['id' => $ticket->id])}}">
                                                                @csrf
                                                                @method('PUT')
                                                                <li class="list-group-item">
                                                                    <label for="holder_id" class="">轉讓給</label>
                                                                    <div class="col-sm-10">
                                                                        <input name="holder_id" type="number" class="form-control" id="holder_id" placeholder="用戶 ID" required>
                                                                    </div>
                                                                    <label for="number" class="">數量</label>
                                                                    <div class="col-sm-10">
                                                                        <input name="number" type="number" class="form-control" id="number" placeholder="數量" required>
                                                                    </div>
                                                                </li>
                                                                <input type="submit" class="btn btn-primary" value="轉讓">
                                                            </form>
                                                        </ul>
                                                        <br>
                                                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a>-->
                                                        <br>
                                                    </div>
                                                </div>
                                                <br>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                <p>有 {{ $duplicateTicketCount }} 張空機票</p>
                            </div>
                        </li>
                    @endforeach
            </ol>
        </div>
    </div>
@endsection
@section('page-scripts')
@stop
