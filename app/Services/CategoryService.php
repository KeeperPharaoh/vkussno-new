<?php

namespace App\Services;

use App\Domain\Contracts\CategoryContract;
use App\Domain\Contracts\ProductContract;
use App\Domain\Repositories\CategoryRepository;
use App\Domain\Repositories\ProductRepository;
use App\Domain\Repositories\SpecialCategoryRepositories;
use Japananimetime\Template\BaseService;

class CategoryService extends BaseService
{
    /**
     * @var \App\Domain\Repositories\CategoryRepository
     */
    private CategoryRepository          $categoryRepository;
    private ProductRepository           $productRepository;
    private SpecialCategoryRepositories $specialCategoryRepositories;

    /**
     * UserService constructor.
     */
    public function __construct(
        CategoryRepository          $categoryRepository,
        ProductRepository           $productRepository,
        SpecialCategoryRepositories $specialCategoryRepositories
    ) {
        parent::__construct();
        $this->categoryRepository          = $categoryRepository;
        $this->productRepository           = $productRepository;
        $this->specialCategoryRepositories = $specialCategoryRepositories;
    }

    public function index(): array
    {
        $categories = $this->categoryRepository->findWhere([
                                                               CategoryContract::PARENT_ID => null,
                                                           ]);

        foreach ($categories as $category) {
            $count           = $this->categoryRepository->getCount($category->id);
            $category->count = $count;
        }

        $imageSpecialCategory = $this->specialCategoryRepositories->first();

        $promotionalImage = $imageSpecialCategory->promotional_image;
        $promotionalCount = $this->productRepository->findWhere([
                                                                    ProductContract::PROMOTIONAL => true,
                                                                ])
                                                    ->count();

        $newImage = $imageSpecialCategory->new_image;
        $newCount = $this->productRepository->findWhere([
                                                            ProductContract::NEW => true,
                                                        ])
                                            ->count();

        $promotional = [
            'id'    => 777,
            'image' => env('APP_URL') . '/storage/' . $promotionalImage,
            'title' => "??????????",
            'count' => $promotionalCount,
        ];

        $new = [
            'id'    => 778,
            'image' => env('APP_URL') . '/storage/' . $newImage,
            'title' => "??????????????",
            'count' => $newCount,
        ];

        return [
            'categories'  => $categories,
            'promotional' => $promotional,
            'new'         => $new,
        ];
    }

    public function showSubCategoriesById(int $id)
    {
        return $this->categoryRepository->findWhere(
            [
                CategoryContract::PARENT_ID => $id,
            ],
            [
                'id', CategoryContract::TITLE,
            ]
        );
    }

}
