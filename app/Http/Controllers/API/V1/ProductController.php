<?php /** @noinspection PhpPossiblePolymorphicInvocationInspection */

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Prettus\Repository\Exceptions\RepositoryException;

class ProductController extends BaseController
{
    public ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /** @noinspection PhpUndefinedFieldInspection
     * @noinspection PhpPossiblePolymorphicInvocationInspection
     */
    public function showProductsBySubCategoryId(Request $request): JsonResponse
    {
        $id    = $request->id;
        $sort  = $request->sort;

        try {
            $result = $this->productService->showProductsBySubCategoryId($id, $sort);
        } catch (RepositoryException $exception) {
            return $this->sendError($exception->getMessage(), $exception->getCode());
        }

        if (isset($result)) {
            return $this->sendResponse($result);
        }else {
            return $this->sendError('Произошла ошибка', 418);
        }
    }

    public function showAllProductsByCategory(Request $request): JsonResponse
    {
        $id = $request->id;
        $sort  = $request->sort;

        try {
            $result = $this->productService->showAllProductsByCategory($id, $sort);
        } catch (RepositoryException $exception) {
            return $this->sendError($exception->getMessage(), $exception->getCode());

        }

        return $this->sendResponse($result);
    }

    public function getProductById(Request $request): JsonResponse
    {
        $id = $request->id;
        $result = $this->productService->getProductById($id);

        return $this->sendResponse($result);
    }

    /** @noinspection PhpUndefinedFieldInspection */
    public function search(Request $request): JsonResponse
    {
        $search = $request->find;
        $sort  = $request->sort;

        $result = $this->productService->search($search, $sort);
        return $this->sendResponse($result);
    }
}
