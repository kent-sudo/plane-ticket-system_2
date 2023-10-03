<?php

namespace App\Http\Controllers\User;

use DB;
use App\Models\Ticket;
use App\Models\Wallet;
use App\Models\Marquee;
use App\Models\OwnedTicket;
use Illuminate\Http\Request;
use App\Service\TicketService;
use App\Models\InternalMessage;
use App\Service\MessageService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\WalletDepositHistory;

class UserDetailsController extends Controller
{
    //票務需求首頁
    const HOME = 'users.';


    public function __construct()
    {
        view()->share('slug', self::HOME);

    }

    public function index(Request $request)
    {
        $chatHistory = InternalMessage::with('messages')->where('user_id',auth('users')->user()->id)->get();
        $tickets = OwnedTicket::with('ticket.flight')->where('user_id', auth('users')->user()->id)->get();
        $walletHistory = WalletDepositHistory::with('wallet')->where('transaction_type',1)->where('wallet_id', auth('users')->user()->wallet->id)->get();

        return view(self::HOME . 'details', compact('tickets','walletHistory','chatHistory'));
    }

    public function bankIn(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'receiver' => 'required',
                'amount' => 'required|numeric',
            ]);

            $wallet = Wallet::where('user_id', auth('users')->user()->id)->firstOrFail();

            $message = WalletDepositHistory::create([
                'transaction_type' => 0,
                'wallet_id' => $wallet->id,
                'bank_code_account_number' => $validatedData['receiver'],
                'amount' => $validatedData['amount'],

            ]);

            // Return success response
            sweetalert()->addSuccess('存款請求成功！請等待審核通過');
            return redirect()->back();

        } catch (\Exception $e) {
            // 处理发生的任何异常或错误
            // 如有必要，记录错误日志
            Log::error('存款錯誤: ' . $e->getMessage());
            sweetalert()->addWarning('存款請求失败! 请稍后重试。');

            // Return error response
            return redirect()->back();
        }
    }

    public function withDraw(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'accountInfo' => 'required',
                'withdrawalAmount' => 'required|numeric',
            ]);

            $wallet = Wallet::where('user_id', auth('users')->user()->id)->firstOrFail();

            $message = WalletDepositHistory::create([
                'transaction_type' => 1,
                'wallet_id' => $wallet->id,
                'bank_code_account_number' => $validatedData['accountInfo'],
                'amount' => $validatedData['withdrawalAmount'],

            ]);

            // Return success response
            sweetalert()->addSuccess('取款請求成功！請等待審核通過');
            return redirect()->back();

        } catch (\Exception $e) {
            // 处理发生的任何异常或错误
            // 如有必要，记录错误日志
            Log::error('存款錯誤: ' . $e->getMessage());
            sweetalert()->addWarning('取款請求失败! 请稍后重试。');

            // Return error response
            return redirect()->back();
        }

    }

    public function sendMessage(Request $request, MessageService $message)
    {
        $result = $message->sendMessage($request);

        return redirect()->back();
    }

    public function sendFollowUpMessage(Request $request, $messageID,MessageService $message)
    {
        $result = $message->sendFollowUpMessage($request,$messageID);

        return redirect()->back();
    }

}
