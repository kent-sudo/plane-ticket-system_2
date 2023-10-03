<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use App\Models\User;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        $flights = Flight::with(['tickets' => function ($query) {
            $query->orderBy('id', 'desc');
        }])->orderBy('id', 'desc')->get();

        return view('admin.ticket_warehouse', ['flights' => $flights]);
    }

    public function search(Request $request)
    {
        // 獲取搜索關鍵字
        $keyword = $request->input('keyword');
        // 檢索符合搜索條件的用戶
        $flight = Flight::with('tickets')
            ->where('flight_number', 'like', "%{$keyword}%")
            ->get();
        // 將用戶數據傳遞給視圖
        return view('admin.ticket_warehouse_search', ['flights' => $flight]);
    }
}
