<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Flight;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Models\TicketRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TicketRequestController extends Controller
{
    public function index()
    {
        $ticketRequests = TicketRequest::with('user')->get();
        $users = User::all();

        return view('admin.ticket_request', compact('ticketRequests','users'));
    }

    public function edit($id)
    {
        $ticketRequest = TicketRequest::with('user')->findOrFail($id);

        return view('admin.ticket_request_edit', compact('ticketRequest'));
    }

    public function create(Request $request)
    {
        try {
            $user_id_get = $request->input('user_id');
            DB::beginTransaction();
            $ticketRequest = new TicketRequest();
            if($user_id_get=="all")
            {
                $userIds = User::all()->pluck('id');
                foreach ($userIds as $userId) {
                    $ticketRequest = new TicketRequest();
                    $ticketRequest->user_id = $userId;
                    $ticketRequest->content = $request->input('content');
                    $ticketRequest->show = $request->input('show');
                    $ticketRequest->save();
                }
            }else{
                $ticketRequest->user_id = $request->input('user_id');
                $ticketRequest->content = $request->input('content');
                $ticketRequest->show = $request->input('show');
                $ticketRequest->save();
            }
            DB::commit();
            return redirect()->route('admin.ticket_request') ->with('success', '新增成功');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.ticket_request') ->with('error', '新增失敗');
        }
    }

    public function update(Request $request,$id)
    {
        try {
            DB::beginTransaction();
            $ticketRequest = TicketRequest::findOrFail($id);
            $ticketRequest->content = $request->input('content');
            $ticketRequest->show = $request->input('show');
            $ticketRequest->save();
            DB::commit();
            return redirect()->route('admin.ticket_request') ->with('success', '修改成功');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.ticket_request') ->with('error', '修改失敗');
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $ticketRequest = TicketRequest::findOrFail($id);
            $ticketRequest->delete();
            DB::commit();
            return redirect()->route('admin.ticket_request') ->with('success', '刪除成功');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.ticket_request') ->with('error', '刪除失敗');
        }
    }


}
