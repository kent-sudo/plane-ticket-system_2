@extends('layouts.backend')
@section('page-styles')
    <script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>
    <!-- 加入一些 CSS 規則 -->
    <style>
        /* 選擇的背景顔色 */
        .status-select {
            border-color: #00a0d2;
            background-color: #f0f8ff;
        }
        /* 選擇存款時的顔色 */
        .status-select option[value="0"]:checked {
            color: red;
            background-color: red;
        }
    </style>
    <style>
        .greenText{ background-color:mediumseagreen; }
        .blueText{ background-color:dodgerblue; }
    </style>
@endsection
<!--  Body Wrapper -->
<!--  Header End -->
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">資金管理</h5>
                <p class="mb-0"></p>
                    <form action="{{route('admin.money_management.search')}}">
                        <div class="input-group mb-3">
                            <input name="keyword" type="text" class="form-control" placeholder="ID" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">查找</button>
                        </div>
                    </form>
                    <form method="get" action="{{route('admin.money_management.status_test')}}">
                        <div class="input-group mb-3">
                            <select class="form-select" name="status_test">
                                <option value="0">等待中</option>
                                <option value="1">完成</option>
                                <option value="2">拒绝</option>
                            </select>
                            <button type="submit" class="btn btn-outline-secondary">查找</button>
                        </div>
                    </form>
                <form method="get" action="{{route('admin.money_management.search_date')}}">
                    <div class="row pb-3">
                        <div class="col-md-3">
                            <label >從</label>
                            <input  style="" type="datetime-local" class="form-control " id="formGroupExampleInput" name="start_date" required>
                        </div>
                        <div class="col-md-3">
                            <label >到</label>
                            <input  style="" type="datetime-local" class="form-control " id="formGroupExampleInput" name="end_date" required>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary">查找</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-body">
                    <h2></h2>
                    <div class="container">
                        <div class="table-responsive">
                            <table class="table table-striped table-sm sortable">
                                <thead>
                                <tr style="font-size: x-small">
                                    <th scope="col">ID</th>
                                    <th scope="col">用戶ID</th>
                                    <th scope="col">用戶姓名</th>
                                    <th scope="col">請求日期</th>
                                    <th scope="col">用戶現額</th>
                                    <th scope="col">交易金額</th>
                                    <th scope="col">交易前金額</th>
                                    <th scope="col">交易后金額</th>
                                    <th scope="col">交易類型</th>
                                    <th scope="col">交易狀態</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($histories as $history)
                                    <tr style="font-size: xx-small">
                                        <td>{{ $history->id }}</td>
                                        <td>{{ $history->wallet->user->id }}</td>
                                        <td>{{ $history->wallet->user->name }}</td>
                                        <td>{{$history->created_at}}</td>
                                        <td>{{ $history->wallet->balance }}</td>
                                        @if($history->transaction_type == 0)
                                            <td style="color:mediumseagreen">+{{ $history->amount}}</td>
                                        @elseif($history->transaction_type == 1)
                                            <td style="color:red">-{{ $history->amount}}</td>
                                        @endif
                                        @if($history->status == 0 ||$history->status == 2)
                                            <td>{{$history->wallet->balance}}</td>
                                            @if($history->transaction_type == 0)
                                                <td style="color:mediumseagreen">{{$history->wallet->balance+$history->amount}}</td>
                                            @elseif($history->transaction_type == 1)
                                                <td style="color:red">{{$history->wallet->balance-$history->amount}}</td>
                                            @endif
                                        @elseif($history->status == 1)
                                            <td>{{$history->amount_before_processing}}</td>
                                            @if($history->transaction_type == 0)
                                                <td style="color:mediumseagreen">{{$history->balance_modification_record}}</td>
                                            @elseif($history->transaction_type == 1)
                                                <td style="color:red">{{$history->balance_modification_record}}</td>
                                            @endif
                                        @endif
                                        <td>
                                            @if($history->transaction_type == 0)
                                                <div class="alert alert-primary" role="alert" style="max-width: 50px;max-height: 30px;text-align: center;padding: 0">
                                                    存款
                                                </div>
                                            @elseif($history->transaction_type == 1)
                                                <div class="alert alert-success" role="alert" style="max-width: 50px;max-height: 30px;text-align: center;padding: 0">
                                                    取款
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if($history->status == 0)
                                                <div class="alert alert-primary" role="alert" style="max-width: 50px;max-height: 30px;text-align: center;padding: 0">
                                                    等待中
                                                </div>
                                            @elseif($history->status == 1)
                                                <div class="alert alert-success" role="alert" style="max-width: 50px;max-height: 30px;text-align: center;padding: 0">
                                                    完成
                                                </div>
                                            @elseif($history->status == 2)
                                                <div class="alert alert-danger" role="alert" style="max-width: 50px;max-height: 30px;text-align: center;padding: 0">
                                                    拒绝
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if($history->status == 0)
                                                <a href="{{ route('money.edit',['id' => $history->id])}}" class="btn btn-sm btn-primary">處理</a>
                                            @elseif($history->status == 1)
                                                已處理
                                            @elseif($history->status == 2)
                                                已處理
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-scripts')

@stop
