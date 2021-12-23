<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\IdRequest;
use App\Http\Resources\CategoryCollection;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Requests\GetCategoryRequest;
use App\Http\Requests\CreateCategoryRequest;
use \Illuminate\Http\JsonResponse;

class CategoryController extends BaseController
{
    public CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(): JsonResponse
    {
        $data = [];
        $result = $this->categoryService->index();
        $categories = new CategoryCollection($result['categories']);

        $special_categories = [
            'promotional' => $result['promotional'],
            'new'         => $result['new']
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

    public function promotional(): JsonResponse
    {
        $result = $this->categoryService->promotional();
        return $this->sendResponse($result);
    }

    public function new(): JsonResponse
    {
        $result = $this->categoryService->new();
        return $this->sendResponse($result);
    }

    public function recommended(): JsonResponse
    {
        $result = $this->categoryService->recommended();
        return $this->sendResponse($result);
    }
}
