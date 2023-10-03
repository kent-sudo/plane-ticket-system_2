<?php

namespace App\Http\Controllers\Admin;

use App\Models\Flight;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Models\InternalMessage;
use App\Service\MessageService;
use App\Http\Controllers\Controller;

class EmailServiceController extends Controller
{
    //票務需求首頁
    const HOME = 'admin.';
    public function __construct()
    {
        view()->share('slug', self::HOME);

    }
    public function index()
    {
        $chatHistory = InternalMessage::with('messages','messages.sender')->get();
        return view(self::HOME. 'email_service',compact('chatHistory'));
    }

    public function followMessage(Request $request, $messageID,MessageService $message)
    {
        $result = $message->sendAdminFollowUpMessage($request,$messageID);

        return redirect()->back();
    }

}
