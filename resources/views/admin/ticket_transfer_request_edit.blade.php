@extends('layouts.backend')

<!--  Body Wrapper -->
<!--  Header End -->
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">交易ID {{$ticketRequest->id}} </h5>
                    <div class="row">
                        <form  method="post" action="{{route('admin.ticket_transfer_request.update',['id' => $ticketRequest->id])}}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="name">用戶姓名</label>
                                <div class="col-sm-10">
                                    <label class="form-control" for="name">{{$ticketRequest->user->name}}</label>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"> 航班 ID {{$ticketRequest->ticket->flight->id}} 航班編號 {{$ticketRequest->ticket->flight->flight_number}} </li>
                                <li  class="list-group-item">票价：{{$ticketRequest->ticket->price}}</li>
                                <li  class="list-group-item">起飛時間：{{$ticketRequest->ticket->flight->departure_time}}</li>
                                <li  class="list-group-item">到達時間：{{$ticketRequest->ticket->flight->arrival_time}}</li>
                                <li  class="list-group-item">起飛地点：{{$ticketRequest->ticket->flight->destination}}</li>
                                <li  class="list-group-item">到達地点：{{$ticketRequest->ticket->flight->departure_location}}</li>
                                <li  class="list-group-item">座位号：{{$ticketRequest->ticket->seat_number}}</li>
                                <li  class="list-group-item">订单号：{{$ticketRequest->ticket->id}}</li>
                                <li  class="list-group-item">擁有著編號：{{$ticketRequest->ticket->holder_id}}</li>
                                <select class="form-select" aria-label="Default select example" disabled="disabled">
                                    <option value="0" {{ $ticketRequest->ticket->status == 0 ? 'selected' : '' }}>已起飛</option>
                                    <option value="1" {{ $ticketRequest->ticket->status == 1 ? 'selected' : '' }}>未起飛</option>
                                    <option value="2" {{$ticketRequest->ticket->status == 2 ? 'selected' : '' }}>延遲</option>
                                    <option value="3" {{ $ticketRequest->ticket->status == 3 ? 'selected' : '' }}>其他</option>
                                </select>
                                <br>
                            </ul>
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">狀況</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" name="status" >
                                        <option value="0" {{ $ticketRequest->status == 0 ? 'selected' : '' }} >等待中</option>
                                        <option value="1" {{ $ticketRequest->status == 1 ? 'selected' : '' }} >完成</option>
                                        <option value="2" {{ $ticketRequest->status == 2 ? 'selected' : '' }} >拒绝</option>
                                    </select>
                                </div>
                            </div>
                            <div id="myId6"></div>
                            <input type="submit" class="btn btn-primary" value="處理">
                        </form>
                        <p></p>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-scripts')
@stop
