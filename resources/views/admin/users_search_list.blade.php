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
                <h5 class="card-title fw-semibold mb-4">用戶資料</h5>
                <p class="mb-0"></p>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive small">
                        <table class="table table-striped table-sm sortable">
                            <thead>
                            <tr>
                                <th scope="col" sorttable_customkey="{{ $users->first()->id }}">用戶ID</th>
                                <th scope="col" sorttable_customkey="{{ $users->first()->name }}">用戶姓名</th>
                                <th scope="col" sorttable_customkey="{{ $users->first()->email }}">用戶郵件</th>
                                <th scope="col" sorttable_customkey="{{ $users->first()->wallet->balance }}">用戶餘額</th>
                                <th scope="col" ></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{ $user->name}}</td>
                                    <td>{{ $user->email}}</td>
                                    @if ($user && $user->wallet->balance)
                                        <td>{{ $user->wallet->balance }}</td>
                                    @else
                                        <td>沒有記錄</td>
                                    @endif
                                    <td><a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-primary btn-sm">修改</a></td>
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
