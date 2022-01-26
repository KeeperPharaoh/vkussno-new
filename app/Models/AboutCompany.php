<?php

namespace App\Models;

use App\Domain\Contracts\AboutContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class AboutCompany extends Model
{
    use HasFactory, Translatable;

    protected array $translatable = [
        AboutContract::TITLE,
        AboutContract::DESCRIPTION
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
