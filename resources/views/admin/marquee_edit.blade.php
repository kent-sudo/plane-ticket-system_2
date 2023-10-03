@extends('layouts.backend')

<!--  Body Wrapper -->
<!--  Header End -->
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">跑馬鐙 ID {{$marquee->id}}</h5>
                    <div class="row">
                        <form  method="post" action="{{route('admin.marquee.update',['id' => $marquee->id])}}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="price">内容</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="price" name="content" placeholder="" value="{{$marquee->content}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-sm-2 col-form-label">顯示</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" name="show">
                                        <option value="0" {{ $marquee->show == 0 ? 'selected' : '' }}>未顯示</option>
                                        <option value="1" {{ $marquee->show == 1 ? 'selected' : '' }}>顯示中</option>
                                    </select>
                                </div>
                            </div>
                            <div id="myId6"></div>
                            <input type="submit" class="btn btn-primary" value="修改">
                        </form>
                        <p></p>
                        <form action="{{ route('marquee_delete', [ 'id' => $marquee->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <input type="submit" class="btn btn-danger" value="刪除">
                        </form>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-scripts')
@stop
