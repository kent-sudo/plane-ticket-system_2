@extends('layouts.backend')
@section('page-styles')
    <script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>
@endsection
<!--  Body Wrapper -->
<!--  Header End -->
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">跑馬鐙</h5>
                <p class="mb-0"></p>
                <form  method="post" enctype="multipart/form-data" action="{{route('marquee_add')}}">
                    @csrf
                    <h7 class=" fw-semibold mb-4">新增跑馬鐙</h7>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-2">
                                内容
                            </div>
                            <div class="col-sm-8" >
                                <input type="text" class="form-control" id="price" name="content" placeholder=""  required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2" >
                                顯示
                            </div>
                            <div class="col-sm-2">
                                <select class="form-select" aria-label="Default select example" name="show">
                                    <option value="0">顯示</option>
                                    <option value="1">不顯示</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2" >
                                <input type="submit" class="btn btn-primary" value="新增">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-body">
                    <h2></h2>
                    <div class="table-responsive small">
                        <table class="table table-striped table-sm sortable">
                            <thead>
                            @if( $marquees->first())
                                <tr>
                                    <th scope="col" sorttable_customkey="{{ $marquees->first()->id }}">跑馬鐙ID</th>
                                    <th scope="col" sorttable_customkey="{{ $marquees->first()->content }}">内容</th>
                                    <th scope="col" sorttable_customkey="{{ $marquees->first()->show }}">顯示</th>
                                    <th scope="col" sorttable_customkey="{{ $marquees->first()->created_at }}">創造時間</th>
                                    <th scope="col" sorttable_customkey="{{ $marquees->first()->updated_at }}">上傳時間</th>
                                    <th scope="col" ></th>
                                </tr>
                            @else
                                <tr>
                                    <th scope="col">沒有資料</th>
                                </tr>
                            @endif
                            </thead>
                            <tbody>
                            @foreach ($marquees as $marquee)
                                <tr>
                                    <td>{{ $marquee->id}}</td>
                                    <td>{{ $marquee->content}}</td>
                                    @if($marquee->show==0)
                                        <td style="color:orangered">未顯示</td>
                                    @else
                                        <td style="color:mediumseagreen">顯示中</td>
                                    @endif
                                    <td>{{  $marquee->created_at}}</td>
                                    <td>{{ $marquee->updated_at}}</td>
                                    <td><a href="{{ route('admin.marquee.edit',['id' => $marquee->id])}}" class="btn btn-primary btn-sm">修改</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!---
                        <div class="test"  style="max-width: 100%"; >
                             //$users->links()
                        </div>
                        -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-scripts')

@stop
