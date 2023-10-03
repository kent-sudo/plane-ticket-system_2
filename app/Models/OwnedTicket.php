<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnedTicket extends Model
{
    use HasFactory;
    
    public static $statusLabels = [
        0 => '等待中',
        1 => '完成',
        2 => '拒绝',
    ];
    protected $fillable = ['user_id', 'ticket_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}