<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flight extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'flight_number',
        'departure_time',
        'arrival_time',
        'destination',
        'departure_location',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($flight) {
            $flight->tickets()->delete();
        });
    }
}
