<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'balance',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function depositHistories()
    {
        return $this->hasMany(WalletDepositHistory::class);
    }

    public function deposits()
    {
        return $this->hasMany(WalletDepositHistory::class);
    }
}
