<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CreateFlightsController extends Controller
{
    public function index()
    {
        return view('admin.ticket_management');
    }

    public function newTicket(Request $request) {
        try {
            DB::beginTransaction();
            $ticket = new Ticket;
            $ticket->flight_id = $request->input('flight_id');
            $ticket->seat_number = $request->input('seat_number');
            $ticket->price = $request->input('price_for_new');
            $ticket->status = $request->input('status');
            $ticket->save();
            DB::commit();
            return redirect()->route('admin.ticket_management')->with('success', '成功');
        } catch (\Exception $e) {
            DB::rollback();
            //return view('admin.ticket_management')->with('error', '航班不存在');
            return redirect()->route('admin.ticket_management')->with('error','航班不存在');
        }
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $flight = new Flight();
            $flight->flight_number = $request->input('flight_number');
            $flight->departure_time = $request->input('departure_time');
            $flight->arrival_time = $request->input('arrival_time');
            $flight->destination = $request->input('destination');
            $flight->departure_location = $request->input('departure_location');
            $flight->save();
            $number_of_ticket = $request->input('number_of_ticket');
            for($i=1;$i<=$number_of_ticket;$i++)
            {
                $ticket = new Ticket();
                $ticket->flight_id = $flight->id;
                $ticket->seat_number = $i;
                $ticket->price = $request->input('price_of_ticket');
                $ticket->status = 1;
                // Set other ticket properties...
                $ticket->save();
            }
            DB::commit();
            return redirect()->route('admin.ticket_management')->with('success', '上傳成功');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.ticket_management')->with('error','上傳失敗');
        }
    }

    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('admin.user_modify_tickets', compact('ticket'));
    }
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $ticket = Ticket::findOrFail($id);
            $ticket->price = $request->input('price');
            $ticket->seat_number = $request->input('seat_number');
            $ticket->status = $request->input('status');
            $ticket->save();
            DB::commit();
            return redirect()->route('user.edit', ['id' => $ticket->holder_id]) ->with('success', '上傳成功');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('user.edit', ['id' => $ticket->holder_id]) ->with('error', '上傳失敗');
        }
    }
    public function TWedit($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('admin.ticket_warehouser_edit', compact('ticket'));
    }
    public function TWupdate(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $ticket = Ticket::findOrFail($id);
            $ticket->price = $request->input('price');
            $ticket->seat_number = $request->input('seat_number');
            $ticket->status = $request->input('status');
            $ticket->save();
            DB::commit();
            return redirect()->route('admin.ticket_warehouse') ->with('success', '上傳成功');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.ticket_warehouse') ->with('error', '上傳失敗');
        }
    }
}
