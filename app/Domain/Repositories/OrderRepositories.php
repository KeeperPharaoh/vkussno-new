<?php

namespace App\Domain\Repositories;

use App\Domain\Contracts\OrderContract;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;

class OrderRepositories extends BaseRepository
{
    public function model(): string
    {
        return Order::class;
    }

    public function accept($cart, $product)
    {
        DB::beginTransaction();
        Order::query()
            ->create([
                OrderContract::CART_ID      => $cart,
                OrderContract::PRODUCT_ID   => $product['id'],
                OrderContract::QUANTITY     => $product['quantity']
                     ]);
        DB::commit();
    }

    public function getOrder($cart_id)
    {
        return Order::query()
                    ->where('cart_id', $cart_id)
                    ->select('product_id', 'quantity')
                    ->first()
        ;
    }
}
