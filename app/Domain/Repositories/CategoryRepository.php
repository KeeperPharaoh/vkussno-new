<?php

namespace App\Domain\Repositories;


use App\Domain\Contracts\CategoryContract;
use Japananimetime\Template\BaseRepository;
use App\Models\Category;

class CategoryRepository extends BaseRepository
{

    public function model(): Category
    {
        return new Category();
    }

    public function getCategory()
    {
        return Category::query()
                       ->where('parent_id', null)
                       ->select('id',CategoryContract::IMAGE,CategoryContract::TITLE)
                       ->get();
    }

    public function getSubCategory($id)
    {
        return Category::query()
                        ->where('parent_id',$id)
                        ->select('id',CategoryContract::TITLE)
                        ->get();
    }
}
