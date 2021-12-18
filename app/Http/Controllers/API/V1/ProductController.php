<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Requests\GetProductRequest;
use App\Http\Requests\CreateProductRequest;
use \Illuminate\Http\JsonResponse;

class ProductController extends BaseController
{
    public ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function showProductsBySubCategoryId(Request $request): JsonResponse
    {
        $id    = $request->id;
        $sort  = $request->sort;

        $result = $this->productService->showProductsBySubCategoryId($id,$sort);

        return $this->sendResponse($result);
    }

    public function showAllProductsByCategory(Request $request): JsonResponse
    {
        $id = $request->id;
        $sort  = $request->sort;

        $result = $this->productService->showAllProductsByCategory($id,$sort);

        return $this->sendResponse($result);
    }

    public function getProductById(Request $request): JsonResponse
    {
        $id = $request->id;
        $result = $this->productService->getProductById($id);

        return $this->sendResponse($result);
    }

    public function search(Request $request): JsonResponse
    {
        $search = $request->find;
        $sort  = $request->sort;

        $result = $this->productService->search($search, $sort);
        return $this->sendResponse($result);
    }
}
