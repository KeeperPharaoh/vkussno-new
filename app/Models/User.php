<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Contracts\UserContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends \TCG\Voyager\Models\User
{
    use HasFactory , SoftDeletes ;
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
            UserContract::NAME,
            UserContract::EMAIL,
            UserContract::EMAIL_VERIFIED_AT,
            UserContract::PHONE,
            UserContract::PASSWORD,
            UserContract::SUBSCRIPTION
    ];

    protected $hidden   = [
            UserContract::SETTINGS,
            UserContract::ROLE_ID,
            UserContract::EMAIL_VERIFIED_AT,
            UserContract::AVATAR,
            UserContract::REMEMBER_TOKEN,
            UserContract::SUBSCRIPTION,
            'deleted_at','created_at','updated_at'
    ];
    protected $perPage = 16;

    protected $table = UserContract::TABLE;

}
