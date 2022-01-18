<?php

namespace App\Models;

use App\Domain\Contracts\TimeOfDeliveryContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeOfDelivery extends Model
{
    use HasFactory;

    protected $hidden = [
        TimeOfDeliveryContract::BLOCK,
        TimeOfDeliveryContract::COUNTER,
        TimeOfDeliveryContract::MAX_COUNTER,
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        TimeOfDeliveryContract::COUNTER,
    ];
}
