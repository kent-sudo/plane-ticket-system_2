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
                <form action="{{route('ticket.search')}}">
                    <div class="input-group mb-3">
                        <input name="keyword" type="text" class="form-control" placeholder="航班編號" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">查找</button>
                    </div>
                </form>
            </div>
            <ol class="list-group list-group-numbered">
                @foreach ($flights as $flight)
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-5 me-auto row">
                            <p>
                                <a class="fw-bold" data-bs-toggle="collapse" href="#collapseExample{{ $flight->id }}" role="button" aria-expanded="false" aria-controls="collapseExample{{ $flight->id }}">
                                    航班 ID {{ $flight->id }} 航班編號 {{$flight->flight_number}}
                                </a>
                            </p>
                            @foreach ($flight->tickets as $ticket)
                            <div class="collapse col-6" id="collapseExample{{ $flight->id }}">
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

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            删除
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">刪除航班</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        確定要刪除航班嗎？
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('flight_delete', [ 'id' =>  $flight->id]) }}" method="POST" class="float-end">
                                            @method('DELETE')
                                            @csrf
                                            <input type="submit" class="btn btn-danger" data-bs-dismiss="modal" value="确认">
                                        </form>
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">取消</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>


@endsection
@section('page-scripts')
@stop
