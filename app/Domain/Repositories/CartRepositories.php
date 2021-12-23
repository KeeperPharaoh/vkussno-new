<?php

namespace App\Domain\Repositories;

use App\Models\Cart;
use App\Models\Product;
use Japananimetime\Template\BaseRepository;

class CartRepositories extends BaseRepository
{
    public function model(): Cart
    {
        return new Cart();
    }

    public function accept()
    {

    }
}
