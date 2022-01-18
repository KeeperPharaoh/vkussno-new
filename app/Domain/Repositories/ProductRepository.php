<?php

namespace App\Domain\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Prettus\Repository\Criteria\RequestCriteria;

class ProductRepository extends BaseRepository
{
    public function model(): string
    {
        return Product::class;
    }

    /**
     * Boot up the repository, pushing criteria
     *
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
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

//    public function getPrice($id)
//    {
//        return Product::query()
//                        ->where('id',$id)
//                        ->select('price')
//                        ->first()
//
//        ;
//    }
//
//    public function getNew(?string $sort): LengthAwarePaginator
//    {
//        $products = Product::query()
//                           ->where(ProductContract::NEW,true);
//
//        if (isset($sort)) {
//            $products->orderBy('price', $sort);
//        }
//
//        return $products->paginate(16);
//    }
//
//    public function getRecommended(?string $sort): LengthAwarePaginator
//    {
//        $products = Product::query()
//                           ->where(ProductContract::RECOMMENDED,true);
//
//        if (isset($sort)) {
//            $products->orderBy('price', $sort);
//        }
//        return $products->paginate(16);
//    }
//
//    public function getCountNew(): int
//    {
//        return Product::query()
//                      ->where(ProductContract::NEW,true)
//                      ->count();
//    }
//
//    public function getProduct($id)
//    {
//        return Product::query()
//               ->where('id', $id)
//               ->select('id', ProductContract::SUBCATEGORY_ID, ProductContract::TITLE, ProductContract::IMAGE, 'price')
//               ->get();
//    }
}
