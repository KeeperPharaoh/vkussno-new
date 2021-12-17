<?php

namespace App\Domain\Repositories;


use App\Domain\Contracts\ProductContract;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Japananimetime\Template\BaseRepository;
use App\Models\Product;
use \Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductRepository extends BaseRepository
{

    public function model(): Product
    {
        return new Product();
    }

    public function showProductsBySubCategoryId($id): LengthAwarePaginator
    {
        return Product::query()
                      ->where('subcategory_id', $id)
                      ->select('id',
                               ProductContract::SUBCATEGORY_ID,
                               ProductContract::TITLE,
                               ProductContract::IMAGE,
                               ProductContract::PRICE,
                               ProductContract::OLD_PRICE,
                      )
                      ->paginate(16)
        ;
    }

    public function getProductsById($products): array
    {
        $result = [];
        foreach ($products as $product) {
            $data     = Product::query()
                            ->where('id',$product->product_id)
                            ->get();
            $result[] = $data;
        }
        return $result;
    }

    public function search($search): LengthAwarePaginator
    {
        return Product::query()
            ->where('title','like',"%{$search}%")
            ->paginate(16)
            ;
    }

    public function isFavorite($id)
    {
        return Favorite::query()
            ->where('product_id', $id)
            ->where('user_id', Auth::guard('sanctum')->id())
            ->first();
    }
}
