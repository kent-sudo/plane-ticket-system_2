@extends('layouts.backend')

<!--  Body Wrapper -->
        <!--  Header End -->
        @section('content')
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">用戶資料</h5>
                    <p class="mb-0"></p>
                    <form action="{{route('admin.search')}}">
                        <div class="input-group mb-3">
                            <input name="keyword" type="text" class="form-control" placeholder="ID" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">查找</button>
                        </div>
                    </form>
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
                                        <h5 class="card-title">用戶密碼 (哈希值) </h5>
                                        <p class="card-text">*******</p>
                                        <h5 class="card-title">用戶郵箱 </h5>
                                        <p class="card-text">{{ $user->email}}</p>
                                        <!-- Example split danger button -->
                                        <h5 class="card-title">機票明细 </h5>
                                        @foreach ($user->tickets as $ticket)
                                            <p>
                                                <span>機票信息 ID ： {{ $ticket->id}}</span>
                                                <button style="float:right" class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#User{{$user->id}}_tickets{{$ticket->id}}" aria-expanded="false" aria-controls="User{{$user->id}}_tickets{{ $ticket->id}}">
                                                    機票信息
                                                </button>
                                            </p>
                                            <div class="collapse" id="User{{$user->id}}_tickets{{ $ticket->id}}">
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
                                                        <select class="form-select" aria-label="Default select example" name="status" disabled="disabled">
                                                            <option value="0" {{ $ticket->status == 0 ? 'selected' : '' }}>已起飛</option>
                                                            <option value="1" {{ $ticket->status == 1 ? 'selected' : '' }}>未起飛</option>
                                                            <option value="4" {{ $ticket->status == 4 ? 'selected' : '' }}>已下架</option>
                                                            <option value="2" {{ $ticket->status == 2 ? 'selected' : '' }}>延遲</option>
                                                            <option value="3" {{ $ticket->status == 3 ? 'selected' : '' }}>其他</option>
                                                        </select>
                                                    </ul>
                                                </div>
                                            </div>
                                            <br>
                                        @endforeach
                                        <h5 class="card-title">轉賬信息</h5>
                                        @if ($user && $user->wallet)
                                            @foreach ($user->wallet->depositHistories as $history)
                                        <p>
                                            <span>轉賬信息 ID ： {{ $history->id}} </span>
                                            <button style="float:right" class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#User{{$user->id}}_money{{ $history->id }}" aria-expanded="false" aria-controls="User{{$user->id}}_money{{ $history->id}}">
                                                金額信息
                                            </button>
                                        </p>
                                        <div class="collapse" id="User{{$user->id}}_money{{  $history->id }}">
                                            <div class="card card-body">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item"></li>
                                                    <li class="list-group-item">轉賬ID：{{$history->id}}</li>
                                                    <li class="list-group-item">提款金額：{{$history->amount}}</li>
                                                    <li class="list-group-item">入賬日期和時間：{{$history->created_at}}</li>
                                                    <li class="list-group-item">提款日期和時間：{{$history->updated_at}}</li>
                                                </ul>
                                            </div>
                                        </div>
                                            <br>
                                            @endforeach
                                        @else
                                            <h6>沒有記錄</h6>
                                            <br>
                                        @endif
                                        <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-primary">修改</a>
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
