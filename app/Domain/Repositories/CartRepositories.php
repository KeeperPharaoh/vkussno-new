<?php

namespace App\Domain\Repositories;

use App\Domain\Contracts\CartContract;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;

class CartRepositories extends BaseRepository
{
    public function model(): string
    {
        return Cart::class;
    }


    public function accept($payment, $address, $totalSum, $user, $comment, $time, $city, $orderStatus)
    {
        $cart = Cart::query()
            ->create([
                CartContract::USER       => $user->id,
                CartContract::SUM        => $totalSum,
                CartContract::STATUS     => $payment->type,
                CartContract::PHONE      => $user->phone,
                CartContract::ADDRESS    => $address->addresses,
                CartContract::APARTMENT  => $address->apartment,
                CartContract::ENTRANCE   => $address->entrance,
                CartContract::FLOOR      => $address->floor,
                CartContract::TIME       => $time,
                CartContract::COMMENT    => $comment,
                CartContract::CITY       => $city,
                CartContract::ORDER_STATUS => $orderStatus,
                CartContract::PAYMENT_STATUS => $payment->type,
                CartContract::PAYMENT_TYPE => $payment->id
                ]);
        return $cart->id;
    }

    public function getCart()
    {
        return Cart::query()
            ->where('user_id', Auth::id())
            ->select('id','status','sum')
            ->orderBy('created_at', 'desc')
            ->get()
            ;
    }
}
