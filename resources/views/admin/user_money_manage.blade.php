@extends('layouts.backend')

<!--  Body Wrapper -->
<!--  Header End -->
@section('content')
        <!--  Header End -->
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">資金管理</h5>
                    <!--<p class="mb-0">This is a sample page </p>-->
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="ID" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">查找</button>
                    </div>
                </div>
                <ol class="list-group list-group-numbered">
                    @for($i=0;$i<5;$i++)
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <p>
                                    <a class="fw-bold" data-bs-toggle="collapse" href="#collapseExample{{$i}}" role="button" aria-expanded="false" aria-controls="collapseExample{{$i}}">
                                        UID 000001
                                    </a>
                                </p>
                                <div class="collapse" id="collapseExample{{$i}}">
                                    <div class="card-body">
                                        <h5 class="card-title fw-semibold mb-4">用戶錢包管理</h5>
                                        <div class="row">
                                            <form>
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col">
                                                            <h5 class="card-title">用户信息</h5>
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item"></li>
                                                                <li class="list-group-item">UID 000001</li>
                                                                <li class="list-group-item">用戶姓名 :姓名</li>
                                                                <li class="list-group-item">用戶郵箱 郵箱</li>
                                                                <li class="list-group-item">錢包餘額 餘額</li>
                                                            </ul>
                                                        </div>
                                                        <div class="col">
                                                            <h5 class="card-title"> </h5>
                                                            <br>
                                                            <div class="form-group ">
                                                                <label for="formGroupExampleInput"> </label>
                                                                <input type="text" class="form-control " id="formGroupExampleInput" placeholder="金額">
                                                            </div>
                                                            <br>
                                                            <a href="#" class="btn btn-primary">增加錢包餘額</a>
                                            </form>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endfor
                </ol>
            </div>
        </div>
@endsection
@section('page-scripts')
@stop
