<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResources;
use Illuminate\Http\Request;
use App\Services\UserService;
use \Illuminate\Http\JsonResponse;

class UserController extends BaseController
{
    public UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function get(): JsonResponse
    {
        $result = $this->userService->getProfile();
        return  $this->sendResponse(new UserResources($result));
    }

    public function update(UserUpdateRequest $request): JsonResponse
    {
        $request = $request->validated();
        $result  = $this->userService->updateProfile($request);

        return $this->sendSuccessMessage($result);
    }

    public function changePassword()
    {

    }

    public function changeCity(int $id): JsonResponse
    {
        $result = $this->userService->changeCity($id);
        if ($result){
            return $this->sendSuccessMessage("Операция прошла успешно");
        } else {
            return $this->sendError('Произошла ошибка');
        }
    }
}
