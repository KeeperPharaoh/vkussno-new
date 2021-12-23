<?php

namespace App\Domain\Repositories;


use App\Domain\Contracts\CategoryContract;
use App\Domain\Contracts\ProductContract;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Japananimetime\Template\BaseRepository;
use App\Models\Category;
use Ramsey\Collection\Collection;

class CategoryRepository extends BaseRepository
{

    public function model(): Category
    {
        return new Category();
    }

    public function getCategory()
    {
        return Category::query()
                       ->where(CategoryContract::PARENT_ID, null)
                       ->select('id',CategoryContract::IMAGE,CategoryContract::TITLE)
                       ->get();
    }

    public function getSubCategory(int $id)
    {
        return Category::query()
                        ->where(CategoryContract::PARENT_ID,$id)
                        ->select('id',CategoryContract::TITLE)
                        ->get();
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
