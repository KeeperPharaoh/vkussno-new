<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\IdRequest;
use App\Http\Resources\CategoryCollection;
use App\Services\ProductService;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Requests\GetCategoryRequest;
use App\Http\Requests\CreateCategoryRequest;
use \Illuminate\Http\JsonResponse;

class CategoryController extends BaseController
{
    public CategoryService $categoryService;
    public ProductService  $productService;

    public function __construct(
        CategoryService $categoryService,
        ProductService  $productService
    )
    {
        $this->categoryService = $categoryService;
        $this->productService  = $productService;
    }

    public function index(): JsonResponse
    {
        $data = [];
        $result = $this->categoryService->index();
        $categories = new CategoryCollection($result['categories']);

        $special_categories = [
             $result['promotional'],
             $result['new']
        ];
        $data = [
            'special_categories' => $special_categories,
            'categories'         => $categories
        ];

        return $this->sendResponse($data);
    }

    public function showSubCategoriesById(Request $request): JsonResponse
    {
        $id = $request->id;
        $result = $this->categoryService->showSubCategoriesById($id);
        return $this->sendResponse($result);
    }

    public function promotional(Request $request): JsonResponse
    {
        $sort   = $request->sort;
        $result = $this->productService->promotional($sort);
        return $this->sendResponse($result);
    }

    public function new(Request $request): JsonResponse
    {
        $sort   = $request->sort;
        $result = $this->productService->new($sort);
        return $this->sendResponse($result);
    }

    public function recommended(Request $request): JsonResponse
    {
        $sort   = $request->sort;
        $result = $this->productService->recommended($sort);
        return $this->sendResponse($result);
    }
}
