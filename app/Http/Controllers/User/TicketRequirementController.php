<?php

namespace App\Http\Controllers\User;

use DB;
use App\Models\Ticket;
use App\Models\Wallet;
use App\Models\Marquee;
use Illuminate\Http\Request;
use App\Models\TicketRequest;
use App\Service\TicketService;
use App\Http\Controllers\Controller;

class TicketRequirementController extends Controller
{
    //票務需求首頁
    const HOME = 'users.';


    public function __construct()
    {
        view()->share('slug', self::HOME);

    }
    
    public function index(Request $request)
    {
        $marquees = Marquee::where('show', 1)->get();
        $tickets = Ticket::with('flight')->where('holder_id', auth('users')->id())->get();
        $ticketRequest = TicketRequest::with('user')->where('show', 1)->get();
        return view(self::HOME . 'index', compact('marquees','ticketRequest','tickets'));
    }

    public function buyTicket(Request $request, Ticket $ticket, TicketService $ticketService)
    {
        return $ticketService->buyTicket($request, $ticket);
    }
    
    public function updateTicketHolder(Request $request, Ticket $ticket, TicketService $ticketService)
    {
        return $ticketService->updateTicketHolder($request, $ticket);
    }
    

    public function create(Request $request)
    {
        DB::beginTransaction();
    
        try {
            $marquee = new Marquee();
            $marquee->content = $request->input('content');
            $marquee->show = $request->input('show');
            $marquee->save();
    
            DB::commit();
    
            return redirect()->back()->with('success', [
                'status' => 'success',
                'title' => '成功',
                'message' => '创建成功！',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
    
            return redirect()->back()->with('error', [
                'status' => 'error',
                'title' => '错误',
                'message' => '创建时发生错误，请稍后重试。',
            ]);
        }
    }
    
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
    
        try {
            $marquee = Marquee::findOrFail($id);
            $marquee->content = $request->input('content');
            $marquee->show = $request->input('show');
            $marquee->save();
    
            DB::commit();
    
            return redirect()->back()->with('success', [
                'status' => 'success',
                'title' => '成功',
                'message' => '更新成功！',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
    
            return redirect()->back()->with('error', [
                'status' => 'error',
                'title' => '错误',
                'message' => '更新时发生错误，请稍后重试。',
            ]);
        }
    }
    
    public function transfer(Request $request, $ticketID, TicketService $ticketService)
    {
        return $ticketService->sellTicket($request, $ticketID);
    }
}
