<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\BaseController;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends BaseController
{
    public AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $result = $this->authService->register($request->validated());
        return $this->sendResponse($result,'Регистрация прошла успешно!');
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $result = $this->authService->login($request->validated());
        if (!$result) {
            return $this->sendError('Неверный номер или пароль',403);
        }

        return $this->sendResponse($result, 'Вход прошел успешно');
    }

    public function logout(): JsonResponse
    {
        $this->authService->logout();
        return response()->json([
            'message'   => 'Операция прошла успешно'
            ]);
    }
}
