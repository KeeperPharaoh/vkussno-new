<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\IdRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\SubCategoryCollection;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Requests\GetCategoryRequest;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
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
        $result = $this->categoryService->index();
        return $this->sendResponse(new CategoryCollection($result));
    }

    public function showSubCategoriesById(Request $request): JsonResponse
    {
        $id = $request->id;
        $result = $this->categoryService->showSubCategoriesById($id);
        return $this->sendResponse($result);
    }
}
