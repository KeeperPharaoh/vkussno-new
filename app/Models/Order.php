<?php

namespace App\Models;

use App\Domain\Contracts\OrderContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        OrderContract::CART_ID,
        OrderContract::QUANTITY,
        OrderContract::PRODUCT_ID
    ];
}
