<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\WalletDepositHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class MoneyController extends Controller
{
    public function index()
    {

    }

    public function edit($id,$user_id)
    {
        $depositHistories = WalletDepositHistory::findOrFail($id);
        return view('admin.user_modify_money', compact('depositHistories'),["user_id"=>$user_id]);
    }
    public function update(Request $request, $id,$user_id)
    {
        //
        try {
            DB::beginTransaction();

            $depositHistories = WalletDepositHistory::findOrFail($id);
            $depositHistories->bank_code_account_number = $request->input('bank_code_account_number');
            $depositHistories->remarks = $request->input('remarks');
            $depositHistories->amount = $request->input('amount');
            $depositHistories->updated_at = $request->input('updated_at');
            $depositHistories->status = $request->input('status');
            $depositHistories->created_at =$request->input('created_at');
            $depositHistories->transaction_type = $request->input('transaction_type');
            $depositHistories->save();
            DB::commit();

            return redirect()->route('user.edit', ['id' => $user_id]) ->with('success', '上傳成功');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('user.edit', ['id' => $user_id]) ->with('error', '上傳失敗');
        }
    }
}
