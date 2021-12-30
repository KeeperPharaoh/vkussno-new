<?php

namespace App\Domain\Repositories;


use App\Domain\Contracts\ProductContract;
use App\Models\Category;
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

    public function showProductsBySubCategoryId(int $id, ?string $sort): LengthAwarePaginator
    {
        $products = Product::query()
                           ->where('subcategory_id', $id)
                           ->select('id',
                                    ProductContract::SUBCATEGORY_ID,
                                    ProductContract::TITLE,
                                    ProductContract::IMAGE,
                                    ProductContract::PRICE,
                                    ProductContract::OLD_PRICE,
                           )
        ;

        if (isset($sort)) {
            $products->orderBy('price', $sort);
        }

        return $products->paginate(16);
    }

    public function showAllProductsByCategory(int $id, ?string $sort): LengthAwarePaginator
    {
        $categoryIds = Category::query()
                               ->where('parent_id', $parentId = Category::query()
                                                                        ->where('id', $id)
                                                                        ->value('id'))
                               ->pluck('id')
                               ->push($parentId)
                               ->all();
        $products   = Product::query()
                             ->whereIn('subcategory_id',$categoryIds)
        ;

        if (isset($sort)) {
            $products->orderBy('price', $sort);
        }

        return $products->paginate(16);
    }

    //ПЕРЕПИСАТЬ
    public function getProductsById($products)
    {
        $ids = [];
        foreach ($products as $product) {
            $ids[] = $product->product_id;
        }

        return Product::query()
                      ->whereIn('id', $ids)
                      ->select('id', 'subcategory_id', 'title', 'image', 'price', 'old_price')
                      ->get()
        ;
    }

    public function search(?string $search, ?string $sort): LengthAwarePaginator
    {
        $products = Product::query()
                           ->where('title','like',"%{$search}%")
        ;

        if (isset($sort)) {
            $products->orderBy('price', $sort);
        }

        return $products->paginate(16);
    }

    public function isFavorite(int $id)
    {
        return Favorite::query()
            ->where('product_id', $id)
            ->where('user_id', Auth::guard('sanctum')->id())
            ->first()
        ;
    }

    public function getPrice($id)
    {
        return Product::query()
                        ->where('id',$id)
                        ->select('price')
                        ->first()

        ;
    }

    public function getPromotional(?string $sort): LengthAwarePaginator
    {
        $products = Product::query()
                           ->where(ProductContract::PROMOTIONAL,true);

        if (isset($sort)) {
            $products->orderBy('price', $sort);
        }
        return $products->paginate(16);
    }

    public function getNew(?string $sort): LengthAwarePaginator
    {
        $products = Product::query()
                           ->where(ProductContract::NEW,true);

        if (isset($sort)) {
            $products->orderBy('price', $sort);
        }

        return $products->paginate(16);
    }

    public function getRecommended(?string $sort): LengthAwarePaginator
    {
        $products = Product::query()
                           ->where(ProductContract::RECOMMENDED,true);

        if (isset($sort)) {
            $products->orderBy('price', $sort);
        }
        return $products->paginate(16);
    }

    public function getCountPromotional(): int
    {
        return Product::query()
                      ->where(ProductContract::PROMOTIONAL,true)
                      ->count();
    }

    public function getCountNew(): int
    {
        return Product::query()
                      ->where(ProductContract::NEW,true)
                      ->count();
    }

    public function getProduct($id)
    {
        return Product::query()
               ->where('id', $id)
               ->select('id', ProductContract::SUBCATEGORY_ID, ProductContract::TITLE, ProductContract::IMAGE, 'price')
               ->get();
    }
}
