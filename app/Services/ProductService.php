<?php

namespace App\Services;

use App\Domain\Contracts\ProductContract;
use App\Domain\Repositories\ProductRepository;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Japananimetime\Template\BaseService;
use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductService extends BaseService
{
    /**
     * @var \App\Domain\Repositories\ProductRepository
     */
    private ProductRepository $productRepository;

    /**
    * UserService constructor.
    */
    public function __construct(ProductRepository $productRepository) {
        parent::__construct();
        $this->productRepository = $productRepository;
    }

    public function showProductsBySubCategoryId(int $id, ?string $sort): LengthAwarePaginator
    {
        $products = $this->productRepository->showProductsBySubCategoryId($id,$sort);

        foreach ($products as $product) {
            $product->image = env('APP_URL') . '/storage/' . $product->image;
            $product->isFavorite = $this->isFavorite($product->id);
        }

        return $products;
    }

    public function showAllProductsByCategory(int $id, ?string $sort): LengthAwarePaginator
    {
        $products = $this->productRepository->showAllProductsByCategory($id,$sort);
        foreach ($products as $product) {
            $product->image = env('APP_URL') . '/storage/' . $product->image;
            $product->isFavorite = $this->isFavorite($product->id);
        }
        return $products;
    }

    public function getProductById(int $id): ?Model
    {
        $result = $this->productRepository->show($id);
        $result->image = env('APP_URL') . '/storage/' . $result->image;
        $result->isFavorite = $this->isFavorite($result->id);
        return $result;
    }

    public function search(?string $search, ?string $sort): LengthAwarePaginator
    {
        $products = $this->productRepository->search($search, $sort);
        foreach ($products as $product) {
            $product->image = env('APP_URL') . '/storage/' . $product->image;
            $product->isFavorite = $this->isFavorite($product->id);
        }
        return $products;
    }

    public function isFavorite(int $id): bool
    {
        if (Auth::guard('sanctum')->check()) {
            $status = $this->productRepository->isFavorite($id);
            return !empty($status);
        }
        return false;
    }
}
