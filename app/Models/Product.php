<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Contracts\ProductContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory , SoftDeletes ;

    protected $fillable = [
            ProductContract::SUBCATEGORY_ID,
            ProductContract::TITLE,
            ProductContract::IMAGE,
            ProductContract::DESCRIPTION,
            ProductContract::PRICE,
    ];
    protected $hidden = [
        ProductContract::PROMOTIONAL,
        ProductContract::NEW,
        ProductContract::RECOMMENDED,
        ProductContract::REMAINDER,
        ProductContract::ORDER,
        'deleted_at',
        'created_at',
        'updated_at',
    ];
    protected $perPage = 16;

    protected $table = ProductContract::TABLE;

    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class, 'subcategory_id');
    }
}
