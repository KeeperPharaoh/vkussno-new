<?php

namespace App\Services;

use App\Domain\Contracts\CategoryContract;
use App\Domain\Repositories\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Japananimetime\Template\BaseService;

class CategoryService extends BaseService
{
    /**
     * @var \App\Domain\Repositories\CategoryRepository
     */
    private CategoryRepository $categoryRepository;

    /**
    * UserService constructor.
    */
    public function __construct(CategoryRepository $categoryRepository) {
        parent::__construct();
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $data = [];
        $categories = $this->categoryRepository->getCategory();
        foreach ($categories as $category){
            $count = $this->categoryRepository->getCount($category->id);
            $category->count = $count;
        }
        return $categories;
    }

    public function showSubCategoriesById(int $id)
    {
        return $this->categoryRepository->getSubCategory($id);
    }
}
