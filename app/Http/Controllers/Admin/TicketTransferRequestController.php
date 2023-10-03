<?php

namespace App\Http\Controllers\Admin;

use App\Models\Flight;
use App\Models\Ticket;
use App\Models\Wallet;
use App\Models\OwnedTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class TicketTransferRequestController extends Controller
{
    public function index()
    {
        $ticketRequests = OwnedTicket::with(['user','ticket'])->get();

        return view('admin.ticket_transfer_request',compact('ticketRequests'));
    }

    public function edit($id)
    {
        $ticketRequest = OwnedTicket::with(['user','ticket','ticket.flight'])->findOrFail($id);

        return view('admin.ticket_transfer_request_edit',compact('ticketRequest'));
    }

    public function status(Request $request)
    {
        $keyword = $request->input('status_test');
        $ticketRequests = OwnedTicket::with(['user','ticket'])->
        where('status', 'like', "{$keyword}")->get();

        return view('admin.ticket_transfer_request',compact('ticketRequests'));
    }

    public function search(Request $request)
    {
        // 獲取搜索關鍵字
        $keyword = $request->input('keyword');
        // 檢索符合搜索條件的用戶
        $ticketRequests = OwnedTicket::with(['user','ticket'])
            ->where('id', 'like', "%{$keyword}%")
            ->get();
        // 將用戶數據傳遞給視圖
        return view('admin.ticket_transfer_request',compact('ticketRequests'));
    }
    public function search_date(Request $request)
    {
        // 獲取搜索關鍵字
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        // 檢索符合搜索條件的用戶
        $ticketRequests = OwnedTicket::with(['user','ticket'])
            ->where('created_at','>=',$start_date)
            ->where('created_at','<=',$end_date)
            ->get();
        // 將用戶數據傳遞給視圖
        return view('admin.ticket_transfer_request',compact('ticketRequests'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $ticketRequest = OwnedTicket::with(['user','ticket'])->findOrFail($id);

            \Log::info($request->input('status'));

            switch ($request->input('status')) {
                case 1:
                    $wallet = Wallet::where('user_id', $ticketRequest->user_id)->lockForUpdate()->first();
                    // 添加用户钱包余额
                    $wallet->balance += $ticketRequest->ticket->price;
                    $wallet->save();

                    $ticketRequest->claimed = 1;
                    break;
                case 2:
                    $ticket = Ticket::findOrFail($ticketRequest->ticket->id);
                    $ticket->update(['holder_id' => $ticketRequest->user_id]);

                    $ticketRequest->claimed = 1;
                    break;
                default:
                    break;
            }


            $ticketRequest->status = $request->input('status');
            $ticketRequest->save();
            DB::commit();
            return redirect()->route('admin.ticket_transfer_request') ->with('success', '修改成功');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('发生错误: '.$e->getMessage());
            return redirect()->route('admin.ticket_transfer_request') ->with('error', '修改失敗');
        }
    }
}
