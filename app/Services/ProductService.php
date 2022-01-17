<?php

namespace App\Services;

use App\Criteria\NewCriteria;
use App\Criteria\PromotionalCriteria;
use App\Criteria\RecommendedCriteria;
use App\Criteria\SubCategoryByCategoryCriteriaCriteria;
use App\Criteria\SubCategoryCriteriaCriteria;
use App\Domain\Contracts\CategoryContract;
use App\Domain\Contracts\FavoriteContract;
use App\Domain\Contracts\ProductContract;
use App\Domain\Repositories\CategoryRepository;
use App\Domain\Repositories\FavoriteRepository;
use App\Domain\Repositories\ProductRepository;
use Illuminate\Support\Facades\Auth;
use Japananimetime\Template\BaseService;
use \Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductService extends BaseService
{
    /**
     * @var \App\Domain\Repositories\ProductRepository
     */
    private ProductRepository $productRepository;
    private CategoryRepository $categoryRepository;
    private FavoriteRepository $favoriteRepository;
    /**
     * UserService constructor.
     */
    public function __construct(
        ProductRepository  $productRepository,
        CategoryRepository $categoryRepository,
        FavoriteRepository $favoriteRepository
    ) {
        parent::__construct();
        $this->categoryRepository = $categoryRepository;
        $this->productRepository  = $productRepository;
        $this->favoriteRepository = $favoriteRepository;
    }

    /**
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function showProductsBySubCategoryId(int $id, ?string $sort)
    {
        $this->productRepository->pushCriteria(new SubCategoryCriteriaCriteria($id));

        return $this->extracted($sort);
    }

    /**
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function showAllProductsByCategory(int $id, ?string $sort)
    {
        $ids        = [];
        $categories = $this->categoryRepository->findWhere([
                                                               CategoryContract::PARENT_ID => $id,
                                                           ]);

        foreach ($categories as $category) {
            $ids [] = $category->id;
        }

        $this->productRepository->pushCriteria(new SubCategoryByCategoryCriteriaCriteria($ids));

        return $this->extracted($sort);
    }

    public function getProductById(int $id)
    {
        $result             = $this->productRepository->find($id);
        $result->image      = env('APP_URL') . '/storage/' . $result->image;
        $result->isFavorite = $this->isFavorite($result->id);

        return $result;
    }

    public function search(?string $search, ?string $sort): LengthAwarePaginator
    {
        $products = $this->productRepository->search($search, $sort);
        foreach ($products as $product) {
            $product->image      = env('APP_URL') . '/storage/' . $product->image;
            $product->isFavorite = $this->isFavorite($product->id);
        }

        return $products;
    }

    /**
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function promotional($sort): LengthAwarePaginator
    {
        $this->productRepository->pushCriteria(new PromotionalCriteria());

        return $this->extracted($sort);
    }

    /**
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function new($sort): LengthAwarePaginator
    {
        $this->productRepository->pushCriteria(new NewCriteria());

        return $this->extracted($sort);
    }

    /**
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function recommended($sort): LengthAwarePaginator
    {
        $this->productRepository->pushCriteria(new RecommendedCriteria());

        return $this->extracted($sort);
    }

    public function isFavorite(int $id): bool
    {
        if (Auth::guard('sanctum')
                ->check()) {
            $status = $this->favoriteRepository->findWhere([
                                                               FavoriteContract::PRODUCT_ID => $id,
                                                               FavoriteContract::USER_ID    => Auth::guard('sanctum')
                                                                   -> id(),
                                                           ])->first();
            return !empty($status);
        }
        return false;
    }

    /**
     * @param string|null $sort
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection|mixed
     */
    public function extracted(?string $sort)
    {
        if ($sort) {
            $products = $this->productRepository->orderBy('price', $sort)
                                                ->paginate(16);
        } else {
            $products = $this->productRepository->orderBy('order', 'ASC')
                                                ->paginate(16);
        }

        foreach ($products as $product) {
            $product->image      = env('APP_URL') . '/storage/' . $product->image;
            $product->isFavorite = $this->isFavorite($product->id);
        }

        return $products;
    }
}
