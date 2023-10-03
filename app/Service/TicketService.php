<?php

namespace App\Service;

use DB, Log;
use App\Models\Ticket;
use App\Models\Wallet;
use App\Models\OwnedTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketService
{
    public function buyTicket(Request $request, Ticket $ticket)
    {
        try {
            // 获取用户信息
            $user = Auth::user();
    
            // 使用数据库事务进行操作
            DB::beginTransaction();
    
            // 锁定用户钱包记录以进行更新
            $wallet = Wallet::where('user_id', $user->id)->lockForUpdate()->first();
    
            // 检查用户钱包余额是否足够支付
            if ($ticket->price > $wallet->balance) {
                // 用户钱包余额不足，抛出异常
                throw new \Exception('用户钱包余额不足');
            }
    
            // 扣除用户钱包余额
            $wallet->balance -= $ticket->price;
            $wallet->save();

            // 提交事务
            DB::commit();
    
            // 写入日志
            Log::info('用户 ' . $user->id . ' 购买票成功。票 ID: ' . $ticket->id);
    
            // 返回成功消息
            return response()->json([
                'status' => 'success',
                'title' => '成功',
                'message' => '购票成功！',
            ]);

        } catch (\Exception $e) {
            // 处理异常，回滚事务
            DB::rollBack();
    
            // 处理购买失败的情况
            Log::error('购买票时发生错误: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'title' => '错误',
                'message' => '购买失败，请稍后重试。',
            ]);
        }
    }

    public function sellTicket(Request $request, $ticketID)
    {
        try {
            // 获取用户信息
            $user = auth('users')->user();
    
            // 使用数据库事务进行操作
            DB::beginTransaction();
    
            // 锁定用户钱包记录以进行更新
            $ticket = Ticket::findOrFail($ticketID);
            // $wallet = Wallet::where('user_id', $user->id)->lockForUpdate()->first();
            
            
            // // 添加用户钱包余额
            // $wallet->balance += $ticket->price;
            // $wallet->save();
    
            $ticket->update(['holder_id' => null]);
            
            // 保存用户曾经拥有的记录
            OwnedTicket::create([
                'user_id' => $user->id,
                'ticket_id' => $ticketID,
                'status' => 0,
                'claimed' => 0,
            ]);            
            
            // 提交事务
            DB::commit();
    
            // 写入日志
            Log::info('用户 ' . $user->id . ' 轉換票。票 ID: ' . $ticket->id);
    
            // 返回成功消息
            return response()->json([
                'status' => 'success',
                'title' => '成功',
                'message' => '轉換申請成功，請等待客服批准',
            ]);
    
        } catch (\Exception $e) {
            // 处理异常，回滚事务
            DB::rollBack();
    
            // 处理购买失败的情况
            Log::error('购买票时发生错误: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'title' => '错误',
                'message' => '轉換失败，请稍后重试。',
            ]);
        }
    }
    


    public function updateTicketHolder(Request $request, Ticket $ticket)
    {
        try {
            // 使用数据库事务进行操作
            DB::beginTransaction();
    
            $oldHolder = $ticket->holder;
            $newHolder = $request->input('new_holder');

            // 更新票的持有人
            $ticket->holder = $newHolder;
            $ticket->save();

            // 提交事务
            DB::commit();
    
            // 写入日志
            Log::info('票的持有人已更新。票 ID: '.$ticket->id.'， 舊持有人ID: '.$oldHolder.'，新持有人ID: '.$newHolder);
    
            // 添加成功消息
            return response()->json([
                'status' => 'success',
                'title' => '成功',
                'message' => '票的持有人已成功更新。',
            ]);
            
        } catch (\Exception $e) {
            // 处理异常，回滚事务
            DB::rollBack();

            // 处理异常
            Log::error('更新票的持有人时发生错误: '.$e->getMessage());
            return response()->json([
                'status' => 'error',
                'title' => '错误',
                'message' => '更新票的持有人时发生错误，请稍后重试。',
            ]);
        }
    }

    
}
