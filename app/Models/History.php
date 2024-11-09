<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'table_histories';

    protected $fillable = [
        'user_id',
        'courier',
        'origin_city',
        'destination_city',
        'weight',
        'cost',
        'created_at'
    ];
}
