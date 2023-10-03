<?php

namespace App\Service;

use App\Models\Messages;
use Illuminate\Http\Request;
use App\Models\InternalMessage;
use Log;

class MessageService
{

    /**
     * Create a new internal message.
     *
     * @param  Request  $request
     * @return array
     */
    public function sendMessage(Request $request)
    {   
        try {

            $validatedData = $request->validate([
                'message' => 'required',
            ]);
            
            $messageID = InternalMessage::create([
                'user_id' => auth('users')->user()->id ?? NULL,
                'type' => $request->get('type') ?? ' ',
            ])->id;
    
            Messages::create([
                'internal_message_id' => $messageID,
                'sender_id' => auth('users')->user()->id ?? NULL,
                'recipient_id' =>  NULL,
                'content' =>  $validatedData['message'],
            ]);
            
            // Return success response
            sweetalert()->addSuccess('留言成功！請等待回復');
            return true;

        } catch (\Exception $e) {
            // 处理发生的任何异常或错误
            // 如有必要，记录错误日志
            Log::error('客服聯係錯誤: ' . $e->getMessage());
            sweetalert()->addWarning('客服聯係失败! 请稍后重试。');

            // Return error response
            return false;
        }

    }


    /**
     * Create a new message.
     *
     * @param  Request  $request
     * @param int $messageID
     * @return array
     */
    public function sendFollowUpMessage(Request $request,$messageID)
    {   
        try {

            $validatedData = $request->validate([
                'message' => 'required',
            ]);
            
            $message = InternalMessage::findOrFail($messageID);

            Messages::create([
                'internal_message_id' => $messageID,
                'sender_id' => $message->user_id,
                'recipient_id' => NULL,
                'content' =>  $validatedData['message'],
            ]);
    
            // Return success response
            sweetalert()->addSuccess('留言成功！請等待回復');
            return true;

        } catch (\Exception $e) {
            // 处理发生的任何异常或错误
            // 如有必要，记录错误日志
            Log::error('客服聯係錯誤: ' . $e->getMessage());
            sweetalert()->addWarning('留言失败! 请稍后重试。');

            // Return error response
            return false;
        }

    }

    /**
     * Create a new message.
     *
     * @param  Request  $request
     * @param int $messageID
     * @return array
     */
    public function sendAdminFollowUpMessage(Request $request,$messageID)
    {   
        try {

            $validatedData = $request->validate([
                'message' => 'required',
            ]);
            
            $message = InternalMessage::findOrFail($messageID);

            Messages::create([
                'internal_message_id' => $messageID,
                'sender_id' => $message->user_id,
                'recipient_id' => auth('admins')->user()->id ?? NULL,
                'content' =>  $validatedData['message'],
            ]);
    
            // Return success response
            sweetalert()->addSuccess('留言成功！');
            return true;

        } catch (\Exception $e) {
            // 处理发生的任何异常或错误
            // 如有必要，记录错误日志
            Log::error('客服聯係錯誤: ' . $e->getMessage());
            sweetalert()->addWarning('留言失败! 请稍后重试。');

            // Return error response
            return false;
        }

    }


}
