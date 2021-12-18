<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\API\V1\CategoryController;
use App\Http\Controllers\API\V1\ProductController;
use App\Http\Controllers\API\V1\FavoriteController;
use App\Http\Controllers\API\V1\AddressController;
use App\Http\Controllers\API\V1\ContentController;

//Регистрация
Route::prefix('auth')->group(function (){
    Route::post('register',[AuthController::class,'register']);
    Route::post('login',[AuthController::class,'login']);
    Route::post('logout',[AuthController::class,'logout'])->middleware('auth:sanctum');
});

//Профиль
Route::middleware('auth:sanctum')->prefix('profile')->group(function () {
    Route::get('get',[UserController::class,'get']);
    Route::put('update',[UserController::class,'update']);
});

//Адресс
Route::middleware('auth:sanctum')->prefix('address')->group(function (){
    Route::get('show',[AddressController::class, 'showUserAddresses']);
    Route::post('add',[AddressController::class, 'add']);
    Route::put('update/{id}', [AddressController::class, 'update']);
    Route::delete('delete/{id}',[AddressController::class, 'delete']);
});

//Категории
Route::prefix('categories')->group(function () {
    Route::get('', [CategoryController::class, 'index']);
    Route::get('{id}/subcategories', [CategoryController::class, 'showSubCategoriesById']);
    Route::get('{id}/products', [ProductController::class, 'showProductsBySubCategoryId']);
    Route::get('{id}/all', [ProductController::class, 'showAllProductsByCategory']);
});

//Продукты
Route::get('product/{id}', [ProductController::class, 'getProductById']);
Route::get('/products/search', [ProductController::class, 'search']);

//Избранное
Route::middleware('auth:sanctum')->prefix('favorite')->group(function (){
    Route::get('show', [FavoriteController::class,'show']);
    Route::post('add/{id}', [FavoriteController::class,'add']);
    Route::delete('delete/{id}', [FavoriteController::class,'delete']);
});

//Контент
Route::prefix('content')->group(function () {
    Route::get('slider',[ContentController::class, 'slider']);
    Route::get('benefit',[ContentController::class, 'benefit']);
    Route::get('about',[ContentController::class, 'about']);
    Route::get('faq',[ContentController::class, 'faq']);
});
