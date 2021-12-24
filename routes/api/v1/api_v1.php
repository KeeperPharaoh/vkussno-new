<?php

use App\Http\Controllers\API\V1\AppSettingsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\API\V1\CategoryController;
use App\Http\Controllers\API\V1\ProductController;
use App\Http\Controllers\API\V1\FavoriteController;
use App\Http\Controllers\API\V1\AddressController;
use App\Http\Controllers\API\V1\ContentController;
use App\Http\Controllers\CartController;

//Регистрация
Route::prefix('auth')->group(function (){
    Route::post('register',[AuthController::class,'register']);
    Route::post('login',[AuthController::class,'login']);
    Route::get('logout',[AuthController::class,'logout'])->middleware('auth:sanctum');
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

    Route::get('/promotional', [CategoryController::class, 'promotional']);
    Route::get('/new', [CategoryController::class, 'new']);
    Route::get('/recommended', [CategoryController::class, 'recommended']);
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

Route::prefix('settings')->group(function () {
    //Цена за доставку
        Route::get('delivery-charges', [AppSettingsController::class, 'getDeliveryCharges']);

    //Получить список городов
        Route::get('city', [AppSettingsController::class, 'city']);

    //Получить время доставки
        Route::get('delivery-time', [AppSettingsController::class, 'getTimeDelivery']);

    //Получить способы оплаты
        Route::get('payment-types', [AppSettingsController::class, 'paymentTypes']);
});

//Корзина
Route::middleware('auth:sanctum')->prefix('cart')->group(function (){
    Route::post('accept',[CartController::class, 'accept']);
});

