<?php

namespace App\Models;

use App\Domain\Contracts\CartContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        CartContract::COMMENT,
        CartContract::TIME,
        CartContract::FLOOR,
        CartContract::ENTRANCE,
        CartContract::USER,
        CartContract::SUM,
        CartContract::PHONE,
        CartContract::STATUS,
        CartContract::ADDRESS,
        CartContract::APARTMENT,
        CartContract::CITY,
        CartContract::PAYMENT_STATUS,
        CartContract::PAYMENT_TYPE,
        CartContract::ORDER_STATUS,
        CartContract::DELIVERY_PRICE,
        CartContract::BONUSES_SPEND
    ];
}
