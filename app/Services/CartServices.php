<?php

namespace App\Services;

use App\Domain\Repositories\CartRepositories;
use App\Domain\Repositories\DeliveryChargerRepositories;
use App\Domain\Repositories\ProductRepository;
use App\Domain\Repositories\TimeDeliveryRepositories;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Japananimetime\Template\BaseRepository;
use Japananimetime\Template\BaseService;

class CartServices extends BaseService
{
    private CartRepositories            $cartRepositories;
    private ProductRepository           $productRepository;
    public function __construct(
        CartRepositories            $cartRepositories,
        ProductRepository           $productRepository
    )
    {
        parent::__construct();
        $this->cartRepositories   = $cartRepositories;
        $this->productRepository  = $productRepository;
    }

    public function accept($attributes)
    {

    }
}
