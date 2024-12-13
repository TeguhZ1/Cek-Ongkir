<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'origin_city',
        'destination_city',
        'weight',
        'courier',
        'service',
        'cost',
        'etd'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
