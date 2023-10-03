<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class ShowUserController extends Controller
{


    public function index()
    {
        // 檢索所有用戶和他們的機票信息
        $users = User::with(['wallet', 'wallet.depositHistories','tickets', 'tickets.flight'])->get();

        // 將用戶數據傳遞給視圖
        return view('admin.user_information', ['users' => $users]);
    }
    public function index2()
    {
        // 檢索所有用戶和他們的機票信息
        $users = User::with(['wallet', 'wallet.depositHistories','tickets', 'tickets.flight'])->get();

        // 將用戶數據傳遞給視圖
        return view('admin.user_information_list', ['users' => $users]);
    }
    public function search_list(Request $request)
    {

        // 獲取搜索關鍵字
        $keyword = $request->input('keyword');

        $user = User::where('id', $keyword)->first();

        if ($user === null) {
            // user doesn't exist
            return redirect()->back()->with('error', '未找到用戶');
        }

        // 檢索符合搜索條件的用戶
        $users = User::with(['wallet', 'wallet.depositHistories','tickets', 'tickets.flight'])
            ->where('id', 'like', "%{$keyword}%")
            ->get();
        // 將用戶數據傳遞給視圖

        return view('admin.users_search_list', ['users' => $users]);
    }
    public function search(Request $request)
    {
        // 獲取搜索關鍵字
        $keyword = $request->input('keyword');
        // 檢索符合搜索條件的用戶
        $users = User::with(['wallet', 'wallet.depositHistories','tickets', 'tickets.flight'])
            ->where('id', 'like', "%{$keyword}%")
            ->get();
        // 將用戶數據傳遞給視圖
        return view('admin.users_search', ['users' => $users]);
    }

    public function edit($id)
    {
        $user_id = $id;
        $users = User::with(['wallet', 'wallet.depositHistories','tickets', 'tickets.flight'])
            ->where('id', 'like', "{$user_id}")
            ->get();
        return view('admin.user_modify', ['users' => $users,'id'=> $id]);
    }

    public function edit2(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $user = User::findOrFail($id);
            $user->name = $request->input('name');
            $user->password = Hash::make($request->input('password'));
            $user->email = $request->input('email');
            $user->save();
            $user->wallet->balance = $request->input('balance');
            $user->wallet->save();
            DB::commit();
            return redirect()->route('admin.user_information_list')->with('success', ' 上傳成功');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.user_information_list')->with('error', ' 上傳失敗');
        }
    }

}
