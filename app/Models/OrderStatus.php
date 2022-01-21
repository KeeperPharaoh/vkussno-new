<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    public function cart()
    {
        return $this->hasOne(Cart::class, 'order_status');
    }
}
