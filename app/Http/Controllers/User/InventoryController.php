<?php

namespace App\Http\Controllers\User;

use DB;
use App\Models\Ticket;
use App\Models\Wallet;
use App\Models\Marquee;
use Illuminate\Http\Request;
use App\Service\TicketService;
use App\Http\Controllers\Controller;

class InventoryController extends Controller
{
    //票務需求首頁
    const HOME = 'users.';


    public function __construct()
    {
        view()->share('slug', self::HOME);

    }
    

    public function index(Request $request)
    {   
        $tickets = Ticket::with('flight')->where('holder_id', auth('users')->id())->get();

        return view(self::HOME . 'inventory', compact('tickets'));
    }

    public function transfer(Request $request, $ticket, TicketService $ticketService)
    {
        return $ticketService->sellTicket($request, $ticket);
    }

    

}
