@extends('layouts.backend')

<!--  Body Wrapper -->
<!--  Header End -->
@section('content')
        <!--  Header End -->
        @foreach ($users as $user)
        <div class="container-fluid">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">用戶id {{$user->id}}</h5>
                <p class="mb-0"></p>
            </div>
            <h5 class="card-title fw-semibold mb-4"></h5>
            <form  method="post" action="{{route('user.edit2',['id' => $user->id])}}">
                @csrf
                @method('PUT')
            <div class="card-body">
                <h5 class="card-title">用戶姓名 </h5>
                <div class="input-group input-group-sm mb-3">
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"  value="{{$user->name}}" name="name" required>
                </div>
                <h5 class="card-title">用戶密碼 </h5>
                <div class="input-group input-group-sm mb-3">
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="*********" name="password" required>
                </div>
                <h5 class="card-title">用戶郵箱 </h5>
                <div class="input-group input-group-sm mb-3">
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="{{$user->email}}" name = "email" required>
                </div>
                <h5 class="card-title">用戶餘額 </h5>
                <div class="input-group input-group-sm mb-3">
                    <input step="any" type="number"  class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="{{$user->wallet->balance }}" name = "balance" required>
                </div>
                <!-- Example split danger button -->
                <h5 class="card-title">售票明细 </h5>
                @foreach ($user->tickets as $ticket)
                    <p>
                        <span>機票信息 ID ： {{ $ticket->id}}</span>
                        <button style="float:right" class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#User{{$user->id}}_tickets{{$ticket->id}}" aria-expanded="false" aria-controls="User{{$user->id}}_tickets{{ $ticket->id}}" >
                            機票信息
                        </button>
                    </p>
                    <div class="collapse" id="User{{$user->id}}_tickets{{ $ticket->id}}">
                        <div class="card card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"></li>
                                <li  class="list-group-item">票价：{{$ticket->price}}</li>
                                <li  class="list-group-item">起飛時間：{{$ticket->flight->departure_time}}</li>
                                <li  class="list-group-item">起飛時間：{{$ticket->flight->arrival_time}}</li>
                                <li  class="list-group-item">起飛地点：{{$ticket->flight->destination}}</li>
                                <li  class="list-group-item">起飛地点：{{$ticket->flight->departure_location}}</li>
                                <li  class="list-group-item">座位号：{{$ticket->seat_number}}</li>
                                <li  class="list-group-item">订单号：{{$ticket->id}}</li>
                                <select class="form-select" aria-label="Default select example" name="status" disabled="disabled">
                                    <option value="0" {{ $ticket->status == 0 ? 'selected' : '' }}>已起飛</option>
                                    <option value="1" {{ $ticket->status == 1 ? 'selected' : '' }}>未起飛</option>
                                    <option value="2" {{ $ticket->status == 2 ? 'selected' : '' }}>延遲</option>
                                    <option value="3" {{ $ticket->status == 3 ? 'selected' : '' }}>其他</option>
                                </select>
                                <a href="{{ route('ticket.edit',['id' => $ticket->id]) }}" class="btn btn-primary">修改</a>
                            </ul>
                        </div>
                    </div>
                    <br>
                @endforeach
                <h5 class="card-title">轉賬信息</h5>
                @if ($user && $user->wallet)
                    @foreach ($user->wallet->depositHistories as $history)
                        <p>
                            <span>轉賬信息 ID ： {{ $history->id}}</span>
                            <button style="float:right" class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#User{{$user->id}}_money{{ $history->id }}" aria-expanded="false" aria-controls="User{{$user->id}}_money{{ $history->id}}">
                                轉賬信息
                            </button>
                        </p>
                        <div class="collapse" id="User{{$user->id}}_money{{  $history->id }}">
                            <div class="card card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"></li>
                                    <li class="list-group-item">金額ID：{{$history->id}}</li>
                                    <li class="list-group-item">錢包ID：{{$history->wallet_id}}</li>
                                    <li class="list-group-item">提款金額：{{$history->amount}}</li>
                                    <li class="list-group-item">銀行代碼：{{$history->bank_code_account_number}}</li>
                                    <li class="list-group-item">金額：{{$history->amount}}</li>
                                    <li class="list-group-item">入賬日期和時間：{{$history->created_at}}</li>
                                    <li class="list-group-item">提款日期和時間：{{$history->updated_at}}</li>
                                    <li class="list-group-item">
                                    <label for="exampleFormControlSelect1" >提款狀態：</label>
                                    <select class="form-control " id="exampleFormControlSelect1" name="status" disabled="disabled" >
                                        <option value="0" {{ $history->status == 0 ? 'selected' : '' }}>等待中</option>
                                        <option value="1" {{ $history->status == 1 ? 'selected' : '' }}>完成</option>
                                        <option value="2" {{ $history->status == 2 ? 'selected' : '' }}>拒绝</option>
                                    </select>
                                    </li>
                                    <li class="list-group-item">
                                    <label for="exampleFormControlSelect1" >交易類型：</label>
                                    <select class="form-control " id="exampleFormControlSelect1" name="transaction_type" disabled="disabled">
                                        <option value="0" {{ $history->transaction_type == 0 ? 'selected' : '' }}>存款</option>
                                        <option value="1" {{ $history->transaction_type == 1 ? 'selected' : '' }}>取款</option>
                                    </select>
                                    </li>
                                    <a href="{{ route('wallet.edit',['id' => $history->id,'user_id'=>$user->id]) }}" class="btn btn-primary">修改</a>
                                </ul>
                            </div>
                        </div>
                        <br>
                    @endforeach
                @else
                    <p>沒有記錄</p>
                @endif
            </div>
                <input type="submit" class="btn btn-primary" value="修改">

            </form>
            <p></p>
            <form action="{{ route('user_delete', [ 'id' => $user->id]) }}" method="POST">
                @method('DELETE')
                @csrf
                <input type="submit" class="btn btn-danger" value="刪除">
            </form>

        </div>
        @endforeach
@endsection
@section('page-scripts')
@stop
