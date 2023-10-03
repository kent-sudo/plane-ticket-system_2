<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class WalletDepositHistory extends Model
{
    use HasFactory;
    public static $transactionTypeLabels = [
        0 => '存款',
        1 => '取款',
    ];

    public static $statusLabels = [
        0 => '等待中',
        1 => '完成',
        2 => '拒绝',
    ];

    protected $fillable = [
        'wallet_id',
        'amount',
        'transaction_type',
        'status',
        'bank_code_account_number',
        'remarks'
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}

