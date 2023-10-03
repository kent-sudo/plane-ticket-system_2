@extends('layouts.backend')

<!--  Body Wrapper -->
<!--  Header End -->
@section('content')
        <!--  Header End -->
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">票務處理</h5>
                    <p class="mb-0"></p>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="card-title fw-semibold mb-6"></h5>
                                <h5 class="card-title">新增 </h5>
                                <p>
                                    <span> 航班信息</span>
                                    <button style="float:right" class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#Flights" aria-expanded="false" aria-controls="Flights">
                                        新增
                                    </button>
                                </p>
                                <div class="collapse" id="Flights">
                                    <div class="card card-body">
                                        <ul class="list-group list-group-flush">
                                        </ul>
                                        <form method="post" action="{{route('admin.ticket_management.store')}}"  enctype="multipart/form-data" id="myId6">
                                            @csrf
                                            <div class="form-group ">
                                                <label for="flight_number" class="col-sm-2 col-form-label">航班編號</label>
                                                <div class="col-sm-10">
                                                    <input name="flight_number" type="text" class="form-control" id="flight_number" placeholder="" required >
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="col-sm-2 col-form-label" for="departure_time">出發時間</label>
                                                <div class="col-sm-10">
                                                   <input name="departure_time" type="datetime-local" class="form-control" id="departure_time" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="col-sm-2 col-form-label" for="arrival_time">到達時間</label>
                                                <div class="col-sm-10">
                                                    <input name="arrival_time" type="datetime-local" class="form-control" id="arrival_time" placeholder="" required >
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="departure_location" class="col-sm-2 col-form-label">起飛地点</label>
                                                <div class="col-sm-10">
                                                    <input name="departure_location" type="text" class="form-control" id="departure_location" placeholder="" required >
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="destination" class="col-sm-2 col-form-label">降落地點</label>
                                                <div class="col-sm-10">
                                                    <input name="destination" type="text" class="form-control" id="destination" placeholder="" required >
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="number_of_ticket" class="col-sm-2 col-form-label">多少機票</label>
                                                <div class="col-sm-10">
                                                    <input name="number_of_ticket" type="number" class="form-control" id="number_of_ticket" oninput="if(value>100)value=100;if(value.length>4)value=value.slice(0,4);if(value<0)value=0"  placeholder="" required >
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="price_of_ticket" class="col-sm-2 col-form-label">機票價格</label>
                                                <div class="col-sm-10">
                                                    <input name="price_of_ticket" type="number" class="form-control" id="price_of_ticket" placeholder="" required >
                                                </div>
                                            </div>
                                            <input type="submit" class="btn btn-primary" value="新增">
                                        </form>
                                    </div>
                                </div>
                                <br>

                                <hr class="mt-2 mb-3"/>
                                <h5 class="card-title">新增機票 </h5>
                                <p>
                                    <span> 機票信息</span>
                                    <button style="float:right" class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                        新增
                                    </button>
                                </p>
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body">
                                        <ul class="list-group list-group-flush">
                                        </ul>
                                        <form method="post" action="{{route('admin.ticket_management.newTicket')}}"  enctype="multipart/form-data" id="myId13">
                                            @csrf
                                            <!-- JavaScript Bundle with Popper -->
                                            <div class="form-group ">

                                                <label for="flight_id" class="col-sm-2 col-form-label">航班ID</label>
                                                <div class="col-sm-10">
                                                    <br>
                                                    <input  name="flight_id" type="number" class="form-control" id="flight_id" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="seat_number" class="col-sm-2 col-form-label">座位號嗎</label>
                                                <div class="col-sm-10">
                                                    <br>
                                                    <input name="seat_number" type="number" class="form-control" id="seat_number" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="price_for_new" class="col-sm-2 col-form-label">機票價格</label>
                                                <div class="col-sm-10">
                                                    <br>
                                                    <input name="price_for_new"  type="number" class="form-control" id="price_for_new" required>
                                                </div>
                                            </div>、
                                            <!--
                                            <div class="form-group row">
                                                <label for="holder_id" class="col-sm-2 col-form-label">用戶ID</label>
                                                <div class="col-sm-10">
                                                    <br>
                                                    <input name="holder_id" type="number" class="form-control" id="holder_id" required>
                                                </div>
                                            </div>
                                            -->
                                            <div class="form-group row">
                                                <label for="status" class="col-sm-2 col-form-label">狀況</label>
                                                <div class="col-sm-10">
                                                    <br>
                                                    <select class="form-select" aria-label="Default select example" name="status" >
                                                        <option value="0" >已起飛</option>
                                                        <option value="1" >未起飛</option>
                                                        <option value="2" >延遲</option>
                                                        <option value="3" >其他</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="myId13"></div>
                                            <br>
                                            <input type="submit" class="btn btn-primary" value="新增">
                                        </form>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('page-scripts')

    <script>
        function showFile()
        {
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function (){
                var dataURL = reader.result;
                var output = document.getElementById('file-preview');
            }
        }
    </script>
@stop
