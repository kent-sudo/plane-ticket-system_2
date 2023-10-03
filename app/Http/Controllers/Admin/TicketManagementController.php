<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TicketManagementController extends Controller
{
    public function index()
    {
        $flights = Flight::with(['tickets' => function ($query) {
            $query->withHolder();
        }])->get();

        $flightsWithoutHolder = Flight::with(['tickets' => function ($query) {
            $query->withoutHolder();
        }])->get();

        return view('admin.transfer_ticket', [
            'flights' => $flights,
            'flightsWithoutHolders' => $flightsWithoutHolder,
        ]);
        /*
        $flights = Flight::with('tickets')->get();
        return view('admin.transfer_ticket', ['flights' => $flights]);*/
    }

    public function indexCheck()
    {
        $flights = Flight::with('tickets')
            ->whereHas('tickets', function ($query) {
                $query->whereNull('holder_id');
            })
            ->get();
        // 將用戶數據傳遞給視圖
        return view('admin.transfer_ticket', ['flights' => $flights]);
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
        return view('admin.transfer_ticket_search', ['flights' => $flight]);
    }

    public function transfer(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $ticket = Ticket::findOrFail($id);
            $ticket->holder_id = $request->input('holder_id');
            $ticket->save();
            DB::commit();
            return redirect()->route('admin.transfer_ticket')->with('success', '成功');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.transfer_ticket')->with('error','用戶不存在');
        }
    }
    public function transfer_many(Request $request, $id)
    {

        try {
            DB::beginTransaction();
            $number = $request->input('number');
            $ticket = Ticket::findOrFail($id);
            $price = $ticket->price;
            $created_at =$ticket->created_at;
            $tickets = Ticket::whereNull('holder_id')->where('price', $price)->where('created_at', $created_at)->limit($number)->get();
            if ($tickets->count() < $number) {
                // 空机票数量不足
                return redirect()->route('admin.transfer_ticket')->with('error', '空機票不夠');
            }
            // 将机票分配给目标用户
            foreach ($tickets as $ticket) {
                $ticket->holder_id =$request->input('holder_id');
                $ticket->save();
            }
            DB::commit();
            return redirect()->route('admin.transfer_ticket')->with('success', '成功');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.transfer_ticket')->with('error','用戶不存在');
        }
    }
}
