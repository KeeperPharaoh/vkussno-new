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
        CartContract::APARTMENT
    ];
}
