<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\BaseController;
use App\Services\FavoriteService;
use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;

class FavoriteController extends BaseController
{
    public FavoriteService $favoriteService;

    public function __construct(FavoriteService $favoriteService)
    {
        $this->favoriteService = $favoriteService;
    }

    public function show(): JsonResponse
    {
        $result = $this->favoriteService->showByUserId();

        return $this->sendResponse($result);
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request): JsonResponse
    {
        try {
            $id    = $request->id;
            $check = $this->favoriteService->check($id);

            if (!$check) {
                return $this->sendError('Товар уже в избранном');
            }

            $this->favoriteService->add($id);

        } catch (\Exception $exception) {
            return $this->sendError("Товара не существует");
        }

        return $this->sendSuccessMessage();
    }

    public function delete(Request $request): JsonResponse
    {
        $id    = $request->id;
        $check = $this->favoriteService->check($id);

        if ($check) {
            return $this->sendError('Товара нету в избранном');
        }

        $this->favoriteService->deleteById($id);

        return $this->sendSuccessMessage('Товар успешно удален');
    }
}
