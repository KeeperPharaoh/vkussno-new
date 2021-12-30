<?php

namespace App\Services;

use App\Domain\Contracts\FavoriteContract;
use App\Domain\Repositories\FavoriteRepository;
use App\Domain\Repositories\ProductRepository;
use Illuminate\Support\Facades\Auth;
use Japananimetime\Template\BaseService;

class FavoriteService extends BaseService
{
    /**
     * @var \App\Domain\Repositories\FavoriteRepository
     */
    private FavoriteRepository $favoriteRepository;
    private ProductRepository $productRepository;

    public function __construct(FavoriteRepository $favoriteRepository,ProductRepository $productRepository)
    {
        parent::__construct();
        $this->favoriteRepository = $favoriteRepository;
        $this->productRepository  = $productRepository;
    }

    public function showByUserId()
    {
        $productsId = $this->favoriteRepository->showByUserId();
        $products   = $this->productRepository->getProductsById($productsId);
        foreach ($products as $product) {
            $product->image = env('APP_URL') . '/storage/' . $product->image;
        }

        return $products;
    }

    public function check(int $id)
    {
        return $this->favoriteRepository->check($id);
    }

    public function add(int $id): \Illuminate\Database\Eloquent\Model
    {
        return $this->favoriteRepository->create([
            FavoriteContract::USER_ID    => Auth::id(),
            FavoriteContract::PRODUCT_ID => $id
            ]);
    }

    public function deleteById(int $id)
    {
        return $this->favoriteRepository->deleteById($id);
    }
}
