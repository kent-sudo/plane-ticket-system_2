@extends('layouts.backend')

<!--  Body Wrapper -->
<!--  Header End -->
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">交易ID {{ $histories->id }}</h5>
                    <div class="row">
                        <form  method="post" action="{{route('transfer_processing.update',['id' => $histories->id])}}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="price">用戶姓名</label>
                                <div class="col-sm-10">
                                    <label class="form-control" for="price">{{$histories->wallet->user->name }}</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="price">用戶餘額</label>
                                <div class="col-sm-10">
                                    <input readonly type="number" step="any" class="form-control" id="price" name="balance" placeholder="" value="{{$histories->wallet->balance}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="amount" class="col-sm-2 col-form-label">處理金額</label>
                                <div class="col-sm-10">
                                    <input readonly type="number" step="any" class="form-control" id="amount" name="amount" placeholder="座位号" value="{{$histories->amount}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="bank_code_account_number" class="col-sm-2 col-form-label">銀行帳號代碼</label>
                                <div class="col-sm-10">
                                    <input readonly type="number" step="any" class="form-control" id="bank_code_account_number" name="bank_code_account_number" placeholder="bank_code_account_number" value="{{$histories->bank_code_account_number}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-sm-2 col-form-label">交易類型</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" name="transaction_type" disabled="disabled">
                                        <option value="0" {{ $histories->transaction_type == 0 ? 'selected' : '' }}>存款</option>
                                        <option value="1" {{ $histories->transaction_type == 1 ? 'selected' : '' }}>取款</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-sm-2 col-form-label">狀況</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" name="status" >
                                        <option value="0" {{ $histories->status == 0 ? 'selected' : '' }}>等待中</option>
                                        <option value="1" {{ $histories->status == 1 ? 'selected' : '' }}>完成</option>
                                        <option value="2" {{ $histories->status == 2 ? 'selected' : '' }}>拒绝</option>
                                    </select>
                                </div>
                            </div>
                            <div id="myId6"></div>
                            <input type="submit" class="btn btn-primary" value="完成">
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
