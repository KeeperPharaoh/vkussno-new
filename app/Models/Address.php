<?php

namespace App\Models;

use App\Domain\Contracts\AddressContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        AddressContract::USER_ID,
        AddressContract::ADDRESS,
        AddressContract::APARTMENT,
        AddressContract::ENTRANCE,
        AddressContract::FLOOR
    ];

    protected $hidden = [
        AddressContract::USER_ID,
        'created_at',
        'updated_at'
    ];
}
