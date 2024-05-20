<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['status', 'total_price', 'session_id', 'items'];

    protected $casts = [
        'items' => 'array',
    ];
}
