@extends('layouts.backend')

<!--  Body Wrapper -->
<!--  Header End -->
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">機票ID {{$ticket->id}}</h5>
                    <div class="row">
                        <form  method="post" action="{{route('ticket_warehouse.update',['id' => $ticket->id])}}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="price">票价</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="price" name="price" placeholder="" value="{{$ticket->price}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="seat_number" class="col-sm-2 col-form-label">座位号</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="seat_number" name="seat_number" placeholder="座位号" value="{{$ticket->seat_number}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-sm-2 col-form-label">狀況</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" name="status">
                                        <option value="0" {{ $ticket->status == 0 ? 'selected' : '' }}>已起飛</option>
                                        <option value="1" {{ $ticket->status == 1 ? 'selected' : '' }}>未起飛</option>
                                        <option value="2" {{ $ticket->status == 2 ? 'selected' : '' }}>延遲</option>
                                        <option value="3" {{ $ticket->status == 3 ? 'selected' : '' }}>其他</option>
                                    </select>
                                </div>
                            </div>
                            <div id="myId6"></div>
                            <input type="submit" class="btn btn-primary" value="修改">
                        </form>
                        <p></p>
                        <form action="{{ route('ticket_delete', [ 'id' => $ticket->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <input type="submit" class="btn btn-danger" value="刪除">
                        </form>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-scripts')
@stop
