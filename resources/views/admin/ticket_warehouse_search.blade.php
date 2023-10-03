@extends('layouts.backend')

<!--  Body Wrapper -->
<!--  Header End -->
@section('content')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">機票管理</h5>
                <!--<p class="mb-0">This is a sample page </p>-->
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
                                                    <li  class="list-group-item">起飛時間：{{$ticket->flight->arrival_time}}</li>
                                                    <li  class="list-group-item">起飛地点：{{$ticket->flight->destination}}</li>
                                                    <li  class="list-group-item">起飛地点：{{$ticket->flight->departure_location}}</li>
                                                    <li  class="list-group-item">座位号：{{$ticket->seat_number}}</li>
                                                    <li  class="list-group-item">擁有人：{{$ticket->holder_id}}</li>
                                                    <li  class="list-group-item">订单号：{{$ticket->id}}</li>
                                                    <select class="form-select" aria-label="Default select example" name="status" disabled="disabled">
                                                        <option value="0" {{ $ticket->status == 0 ? 'selected' : '' }}>已起飛</option>
                                                        <option value="1" {{ $ticket->status == 1 ? 'selected' : '' }}>未起飛</option>
                                                        <option value="2" {{ $ticket->status == 2 ? 'selected' : '' }}>延遲</option>
                                                        <option value="3" {{ $ticket->status == 3 ? 'selected' : '' }}>其他</option>
                                                    </select>
                                                </ul>
                                                <br>
                                                <a href="{{ route('ticket_warehouse.edit',['id' => $ticket->id])}}" class="btn btn-primary">修改</a>
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
            </ol>
        </div>
    </div>
@endsection
@section('page-scripts')
@stop
