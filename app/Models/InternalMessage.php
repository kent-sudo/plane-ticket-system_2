<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'user_id',
    ];

    public function messages()
    {
        return $this->hasMany(Messages::class);
    }
    
}
