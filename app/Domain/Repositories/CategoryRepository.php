<?php

namespace App\Domain\Repositories;


use App\Domain\Contracts\CategoryContract;
use App\Domain\Contracts\ProductContract;
use App\Models\Product;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Category;

class CategoryRepository extends BaseRepository
{

    public function model(): string
    {
        return Category::class;
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

    public function getCount(int $id): int
    {
        $categoryIds = Category::query()
                               ->where(CategoryContract::PARENT_ID, $parentId = Category::query()
                                                                        ->where('id', $id)
                                                                        ->value('id'))
                               ->pluck('id')
                               ->push($parentId)
                               ->all();

        return Product::query()
                      ->whereIn(ProductContract::SUBCATEGORY_ID,$categoryIds)
                      ->count()
        ;
    }

}
