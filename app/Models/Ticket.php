<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'flight_id',
        'seat_number',
        'price',
        'holder_id',
        'status',
    ];

    public function scopeWithHolder($query)
    {
        return $query->whereNotNull('holder_id');
    }

    public function scopeWithoutHolder($query)
    {
        return $query->whereNull('holder_id');
    }

    public function holder()
    {
        return $this->belongsTo(User::class, 'holder_id');
    }


    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }
}
