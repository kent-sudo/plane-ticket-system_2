@extends('layouts.backend')

<!--  Body Wrapper -->
<!--  Header End -->
@section('content')
        <!--  Header End -->
        <div class="container-fluid">
            <div class="card">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">订单号 {{$depositHistories->id}}  錢包ID {{$depositHistories->wallet_id}}</h5>
                        <div class="row">
                            <form  method="post" action="{{route('wallet.update',['id' => $depositHistories->id,'user_id'=>$user_id])}}">
                                @csrf
                                @method('PUT')
                                <div class="form-group ">
                                    <label for="formGroupExampleInput">帳戶號碼</label>
                                    <input type="text" class="form-control " id="formGroupExampleInput" name="bank_code_account_number" placeholder="{{$depositHistories->bank_code_account_number}}" value="{{$depositHistories->bank_code_account_number}}" required>
                                </div>
                                <div class="form-group ">
                                    <label for="formGroupExampleInput">備註</label>
                                    <input type="text" class="form-control " id="formGroupExampleInput"  name="remarks" placeholder="{{$depositHistories->remarks}}" value="{{$depositHistories->remarks}}" required>
                                </div>
                                <div class="form-group ">
                                    <label for="formGroupExampleInput">提款金額</label>
                                    <input type="text" class="form-control " id="formGroupExampleInput" name="amount"  placeholder="{{$depositHistories->amount}}" value="{{$depositHistories->amount}}" required>
                                </div>
                                <div class="form-group ">
                                    <label for="formGroupExampleInput">提款日期和時間</label>
                                    <input  type="datetime-local" class="form-control " id="formGroupExampleInput" name="update_at" placeholder="{{$depositHistories->updated_at}}" value="{{$depositHistories->updated_at}}" required>
                                <div>
                                    <label for="formGroupExampleInput">入賬日期和時間</label>
                                    <input  type="datetime-local" class="form-control " id="formGroupExampleInput" name="created_at" placeholder="{{$depositHistories->created_at}}" value="{{$depositHistories->created_at}}" required>
                                </div>
                                <div class="form-group ">
                                    <label for="exampleFormControlSelect1" >提款狀態：</label>
                                    <select class="form-control " id="exampleFormControlSelect1" name="status" >
                                        <option value="0" {{ $depositHistories->status == 0 ? 'selected' : '' }}>等待中</option>
                                        <option value="1" {{ $depositHistories->status == 1 ? 'selected' : '' }}>完成</option>
                                        <option value="2" {{ $depositHistories->status == 2 ? 'selected' : '' }}>拒绝</option>
                                    </select>
                                </div>
                                <div class="form-group ">
                                    <label for="exampleFormControlSelect1" >交易類型：</label>
                                    <select class="form-control " id="exampleFormControlSelect1" name="transaction_type">
                                        <option value="0" {{ $depositHistories->transaction_type == 0 ? 'selected' : '' }}>存款</option>
                                        <option value="1" {{ $depositHistories->transaction_type == 1 ? 'selected' : '' }}>取款</option>
                                    </select>
                                </div>
                                <br>
                                <input type="submit" class="btn btn-primary" value="修改">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('page-scripts')
@stop
