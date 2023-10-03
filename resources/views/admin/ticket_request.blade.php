@extends('layouts.backend')

@section('page-styles')
    <script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">票務需求</h5>
                <p class="mb-0"></p>
                <form method="post" enctype="multipart/form-data" action="{{ route('admin.ticket_request.create') }}">
                    @csrf
                    <h5 class="fw-semibold mb-4">新增票務需求</h5>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-2">
                                會員
                            </div>
                            <div class="col-sm-8">
                                <select class="form-select" aria-label="Default select example" name="user_id" required>
                                    <option value="">選擇會員</option>
                                    <option value="all">所有會員</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-2">
                                內容
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="content" name="content" placeholder="" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-2">
                                顯示
                            </div>
                            <div class="col-sm-2">
                                <select class="form-select" aria-label="Default select example" name="show" required>
                                    <option value="1">顯示</option>
                                    <option value="0">不顯示</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <input type="submit" class="btn btn-primary" value="新增">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h2></h2>
                <div class="table-responsive small">
                    <table class="table table-striped table-sm sortable">
                        <thead>
                            @if($ticketRequests->first())
                                <tr>
                                    <th scope="col" sorttable_customkey="{{ $ticketRequests->first()->id }}">票務需求ID</th>
                                    <th scope="col" sorttable_customkey="{{ $ticketRequests->first()->user_id }}">用戶名稱</th>
                                    <th scope="col" sorttable_customkey="{{ $ticketRequests->first()->content }}">內容</th>
                                    <th scope="col" sorttable_customkey="{{ $ticketRequests->first()->show }}">顯示</th>
                                    <th scope="col" sorttable_customkey="{{ $ticketRequests->first()->created_at }}">創建時間</th>
                                    <th scope="col" sorttable_customkey="{{ $ticketRequests->first()->updated_at }}">更新時間</th>
                                    <th scope="col"></th>
                                </tr>
                            @else
                                <tr>
                                    <th scope="col">沒有資料</th>
                                </tr>
                            @endif
                        </thead>
                        <tbody>
                            @foreach ($ticketRequests as $ticketRequest)
                                <tr>
                                    <td>{{ $ticketRequest->id }}</td>
                                    <td>{{ $ticketRequest->user->name }}</td>
                                    <td>{{ $ticketRequest->content }}</td>
                                    @if($ticketRequest->show == 0)
                                        <td style="color: orangered">未顯示</td>
                                    @else
                                        <td style="color: mediumseagreen">顯示中</td>
                                    @endif
                                    <td>{{ $ticketRequest->created_at }}</td>
                                    <td>{{ $ticketRequest->updated_at }}</td>
                                    <td><a href="{{ route('admin.ticket_request.edit', ['id' => $ticketRequest->id]) }}" class="btn btn-primary btn-sm">修改</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')

@stop
