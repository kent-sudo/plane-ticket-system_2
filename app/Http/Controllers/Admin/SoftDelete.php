<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Marquee;
use App\Models\User;
use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Ticket;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SoftDelete extends Controller
{
    use SoftDeletes;
    public function destroy ($id)
    {
        try {
            DB::beginTransaction();
            $ticket = Ticket::findOrFail ($id);
            $ticket->delete ();
            DB::commit();
            return redirect ()->route('admin.ticket_warehouse')->with ('success', '機票刪除成功');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect ()->route('admin.ticket_warehouse')->with ('error', '機票刪除失敗');
        }
    }
    public function destroyUser ($id)
    {
        try {
            DB::beginTransaction();
            $user = User::findOrFail ($id);
            $user->delete ();
            DB::commit();
            return redirect ()->route('admin.user_information')->with ('success', '用戶刪除成功');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect ()->route('admin.user_information')->with ('error', '用戶刪除失敗');
        }
    }
    public function destroyMarquee ($id)
    {
        try {
            DB::beginTransaction();
            $marquee = Marquee::findOrFail ($id);
            $marquee->delete ();
            DB::commit();
            return redirect ()->route('admin.marquee')->with ('success', '走馬燈刪除成功');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect ()->route('admin.marquee')->with ('error', '走馬燈刪除失敗');
        }
    }
    public function destroyFlight ($id)
    {
        try {
            DB::beginTransaction();
            $flight = Flight::findOrFail ($id);
            $flight->delete ();
            DB::commit();
            return redirect ()->route('admin.ticket_warehouse')->with ('success', '航班刪除成功');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect ()->route('admin.ticket_warehouse')->with ('error', '航班刪除失敗');
        }
    }
}
