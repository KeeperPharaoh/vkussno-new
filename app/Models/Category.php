<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Contracts\CategoryContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use TCG\Voyager\Traits\Translatable;

class Category extends Model
{
    use HasFactory , SoftDeletes, Translatable ;

    protected $fillable = [
            CategoryContract::TITLE,
            CategoryContract::IMAGE,
    ];
    protected $translatable = [
            CategoryContract::TITLE
    ];
    protected $hidden = [
            'deleted_at',
            'created_at',
            'updated_at'
    ];
    protected $perPage = 16;

    protected $table = CategoryContract::TABLE;

}
