<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;

    protected $fillable = [
        'internal_message_id',
        'sender_id',
        'recipient_id',
        'content',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function recipient()
    {
        return $this->belongsTo(Admin::class, 'recipient_id');
    }
    
    public function internalMessage()
    {
        return $this->belongsTo(InternalMessage::class);
    }
}

