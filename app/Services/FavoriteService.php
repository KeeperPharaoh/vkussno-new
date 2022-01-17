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
        $ids = [];
        $productsIds = $this->favoriteRepository->findWhere([
            FavoriteContract::USER_ID => Auth::id()
            ]);

        foreach ($productsIds as $productsId) {
            $ids[] = $productsId->product_id;
        }

        $products   = $this->productRepository->findWhereIn('id',$ids);

        foreach ($products as $product) {
            $product->image = env('APP_URL') . '/storage/' . $product->image;
            $product->isFavorite = true;
        }

        return $products;
    }

    public function check(int $id): bool
    {
        $status = $this->favoriteRepository->findWhere([
                       FavoriteContract::USER_ID    => Auth::id(),
                       FavoriteContract::PRODUCT_ID => $id,
              ]);

        return $status->isEmpty();
    }

    /**
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function add(int $id)
    {
        return $this->favoriteRepository->create([
            FavoriteContract::USER_ID    => Auth::id(),
            FavoriteContract::PRODUCT_ID => $id
            ]);
    }

    public function deleteById(int $id): int
    {
        return $this->favoriteRepository->deleteWhere([
                      FavoriteContract::USER_ID    => Auth::id(),
                      FavoriteContract::PRODUCT_ID => $id,
                 ]);
    }
}
