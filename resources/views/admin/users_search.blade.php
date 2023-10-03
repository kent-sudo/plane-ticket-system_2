@extends('layouts.backend')

<!--  Body Wrapper -->
<!--  Header End -->
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">用戶資料</h5>
                <p class="mb-0"></p>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @foreach ($users as $user)
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        用户ID ： {{$user->id}}
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">用戶姓名 </h5>
                                        <p class="card-text">{{ $user->name}}</p>
                                        <h5 class="card-title">用戶密碼 </h5>
                                        <p class="card-text">{{ $user->password}}</p>
                                        <h5 class="card-title">用戶郵箱 </h5>
                                        <p class="card-text">{{ $user->email}}</p>
                                        <!-- Example split danger button -->
                                        <h5 class="card-title">售票明细 </h5>
                                        @foreach ($user->tickets as $ticket)
                                            <p>
                                                <span>售票明细 1</span>
                                                <button style="float:right" class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#User{{$user->id}}_tickets{{$ticket->id}}" aria-expanded="false" aria-controls="User{{$user->id}}_tickets{{ $ticket->id}}">
                                                    機票信息
                                                </button>
                                            </p>
                                            <div class="collapse" id="User{{$user->id}}_tickets{{ $ticket->id}}">
                                                <div class="card card-body">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item"></li>
                                                        <li  class="list-group-item">票价：{{$ticket->flight->departure_time}}</li>
                                                        <li  class="list-group-item">起飛時間：{{$ticket->flight->departure_time}}</li>
                                                        <li  class="list-group-item">起飛時間：{{$ticket->flight->arrival_time}}</li>
                                                        <li  class="list-group-item">起飛地点：{{$ticket->flight->destination}}</li>
                                                        <li  class="list-group-item">起飛地点：{{$ticket->flight->departure_location}}</li>
                                                        <li  class="list-group-item">座位号：{{$ticket->seat_number}}</li>
                                                        <li  class="list-group-item">订单号：{{$ticket->id}}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <br>
                                        @endforeach
                                        <h5 class="card-title">金額信息</h5>
                                        @foreach ($user->wallet->depositHistories as $history)
                                            <p>
                                                <span>金額信息 1</span>
                                                <button style="float:right" class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#User{{$user->id}}_money{{ $history->id }}" aria-expanded="false" aria-controls="User{{$user->id}}_money{{ $history->id}}">
                                                    金額信息
                                                </button>
                                            </p>
                                            <div class="collapse" id="User{{$user->id}}_money{{  $history->id }}">
                                                <div class="card card-body">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item"></li>
                                                        <li class="list-group-item">金額ID：{{$history->id}}</li>
                                                        <li class="list-group-item">提款金額：{{$history->amount}}</li>
                                                        <li class="list-group-item">入賬日期和時間：{{$history->created_at}}</li>
                                                        <li class="list-group-item">提款日期和時間：{{$history->updated_at}}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <br>
                                        @endforeach
                                        <a href="{{ route('admin.user_modify') }}" class="btn btn-primary">修改</a>
                                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a>-->
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-scripts')
@stop
