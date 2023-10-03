<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletDepositHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class MoneyManagementController extends Controller
{
    public function index()
    {
        // 檢索所有用戶和他們的機票信息
        $histories = WalletDepositHistory::with('wallet.user')->get();
        // 將用戶數據傳遞給視圖
        return view('admin.money_management', ['histories' => $histories]);
    }
    public function search_date(Request $request)
    {
        // 獲取搜索關鍵字
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        // 檢索符合搜索條件的用戶
        $histories = WalletDepositHistory::with('wallet.user')
            ->where('created_at','>=',$start_date)
            ->where('created_at','<=',$end_date)
            ->get();
        // 將用戶數據傳遞給視圖
        return view('admin.money_management', ['histories' => $histories]);
    }
    public function status_test(Request $request)
    {
        // 獲取搜索關鍵字
        $keyword = $request->input('status_test');
        // 檢索符合搜索條件的用戶
        $histories = WalletDepositHistory::with('wallet.user')
            ->where('status', 'like', "{$keyword}")
            ->get();
        // 將用戶數據傳遞給視圖
        return view('admin.money_management', ['histories' => $histories]);
    }
    public function search(Request $request)
    {
        // 獲取搜索關鍵字
        $keyword = $request->input('keyword');
        // 檢索符合搜索條件的用戶
        $histories = WalletDepositHistory::with('wallet.user')
            ->where('id', 'like', "%{$keyword}%")
            ->get();
        // 將用戶數據傳遞給視圖
        return view('admin.money_management', ['histories' => $histories]);
    }
    public function edit($id)
    {
        $histories = WalletDepositHistory::with('wallet.user')->findOrFail($id);
        return view('admin.transfer_processing', compact('histories'));
    }
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $histories = WalletDepositHistory::findOrFail($id);
            $histories->status = $request->input('status');
            $temp_balance =0;
            if($histories->status == 1)
            {
                $histories->amount_before_processing = $histories->wallet->balance;
                if($histories->transaction_type==0)
                {
                    $temp_balance = $histories->wallet->balance+$histories->amount;
                    $histories->balance_modification_record= $temp_balance;
                }elseif ($histories->transaction_type==1)
                {
                    $temp_balance = $histories->wallet->balance-$histories->amount;
                    $histories->balance_modification_record= $temp_balance;
                }
            }
            $histories->save();
            if($histories->status == 1)
            {
                $histories->wallet->balance = $temp_balance;
            }
            $histories->wallet->save();
            DB::commit();

            return redirect()->route('admin.money_management') ->with('success', '上傳成功');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.money_management') ->with('error', '上傳失敗');

        }
    }
}
