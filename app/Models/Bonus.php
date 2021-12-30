<?php

namespace App\Models;

use App\Domain\Contracts\BonusContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    use HasFactory;

    protected $table = BonusContract::TABLE;

    protected $fillable = [BonusContract::PERCENT];

    protected $hidden   = [
        'created_at',
        'updated_at'
    ];
}
