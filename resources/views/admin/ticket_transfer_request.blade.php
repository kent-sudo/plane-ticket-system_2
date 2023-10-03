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
        .greenText {
            background-color: mediumseagreen;
        }

        .blueText {
            background-color: dodgerblue;
        }
    </style>
@endsection
<!--  Body Wrapper -->
<!--  Header End -->
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">轉讓請求</h5>
                <p class="mb-0"></p>
                <form action="{{route('admin.ticket_transfer_request_search')}}">
                    <div class="input-group mb-3">
                        <input name="keyword" type="text" class="form-control" placeholder="ID" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">查找</button>
                    </div>
                </form>
                <form method="get" action="{{route('admin.ticket_transfer_request_status')}}">
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
                                        <th scope="col">交易ID</th>
                                        <th scope="col">用戶ID</th>
                                        <th scope="col">用戶姓名</th>
                                        <th scope="col">請求日期</th>
                                        <th scope="col">請求機票ID</th>
                                        <th scope="col">交易金額</th>
                                        <th scope="col">交易狀態</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ticketRequests as $ticketRequest)
                                        @if($ticketRequest->ticket)
                                            <tr style="font-size: xx-small">
                                                <td>{{ $ticketRequest->id }}</td>
                                                <td>{{ $ticketRequest->user_id }}</td>
                                                <td>{{ $ticketRequest->user->name }}</td>
                                                <td>{{ $ticketRequest->created_at }}</td>
                                                <td>{{ $ticketRequest->ticket->id }}</td>
                                                <td>{{ $ticketRequest->ticket->price }}</td>
                                                <td>{{ \App\Models\OwnedTicket::$statusLabels[$ticketRequest->status] }}</td>
                                                <td>
                                                    @if ($ticketRequest->status == 0)
                                                        <a href="{{ route('admin.ticket_transfer_request_edit', ['id' => $ticketRequest->id]) }}"
                                                           class="btn btn-sm btn-primary">處理</a>
                                                    @elseif($ticketRequest->status == 1)
                                                        完成
                                                    @elseif($ticketRequest->status == 2)
                                                        拒绝
                                                    @endif
                                                </td>
                                            </tr>
                                        @else
                                            <tr style="font-size: xx-small">
                                                <td>{{ $ticketRequest->id }}</td>
                                                <td>{{ $ticketRequest->user_id }}</td>
                                                <td>{{ $ticketRequest->user->name }}</td>
                                                <td>{{ $ticketRequest->created_at }}</td>
                                                <td>機票已被刪除</td>
                                                <td>機票已被刪除</td>
                                                <td>機票已被刪除</td>
                                                <td>機票已被刪除</td>
                                            </tr>
                                        @endif
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
