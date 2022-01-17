<?php

namespace App\Services;

use App\Domain\Contracts\CartContract;
use App\Domain\Contracts\OrderContract;
use App\Domain\Repositories\AddressRepositories;
use App\Domain\Repositories\BonusRepositories;
use App\Domain\Repositories\CartRepositories;
use App\Domain\Repositories\DeliveryChargerRepositories;
use App\Domain\Repositories\OrderRepositories;
use App\Domain\Repositories\PaymentTypeRepository;
use App\Domain\Repositories\ProductRepository;
use App\Domain\Repositories\PromoRepositories;
use App\Domain\Repositories\TimeDeliveryRepositories;
use App\Domain\Repositories\UserRepository;
use App\Models\Bonus;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Japananimetime\Template\BaseRepository;
use Japananimetime\Template\BaseService;

class CartServices extends BaseService
{
    private CartRepositories $cartRepositories;
    private ProductRepository $productRepository;
    private TimeDeliveryRepositories $timeDeliveryRepositories;
    private PaymentTypeRepository $paymentTypeRepository;
    private UserRepository $userRepository;
    private AddressRepositories $addressRepositories;
    private PromoRepositories $promoRepositories;
    private BonusRepositories $bonusRepositories;
    private OrderRepositories $orderRepositories;

    public function __construct(
        CartRepositories         $cartRepositories,
        ProductRepository        $productRepository,
        TimeDeliveryRepositories $timeDeliveryRepositories,
        PaymentTypeRepository    $paymentTypeRepository,
        UserRepository           $userRepository,
        AddressRepositories      $addressRepositories,
        PromoRepositories        $promoRepositories,
        BonusRepositories        $bonusRepositories,
        OrderRepositories        $orderRepositories
    ) {
        parent::__construct();
        $this->cartRepositories         = $cartRepositories;
        $this->productRepository        = $productRepository;
        $this->timeDeliveryRepositories = $timeDeliveryRepositories;
        $this->paymentTypeRepository    = $paymentTypeRepository;
        $this->userRepository           = $userRepository;
        $this->addressRepositories      = $addressRepositories;
        $this->promoRepositories        = $promoRepositories;
        $this->bonusRepositories        = $bonusRepositories;
        $this->orderRepositories        = $orderRepositories;
    }

    /** @noinspection PhpUndefinedFieldInspection */
    public function accept($attributes)
    {
        $addressId     = $attributes['address'];
        $products      = $attributes['data'];
        $totalSum      = 0;
        $bonus         = $attributes['bonus'];
        $paymentTypeId = $attributes['payment_type'];
        $comment       = $attributes['comment'];
        $timeId        = $attributes['delivery_time'];
        $user          = Auth::user();
        $userBonus     = $user->bonus;

        foreach ($products as $product) {
            $productPrice = $this->productRepository->getPrice($product['id']);
            $totalSum     += $productPrice->price * $product['quantity'];
        }

        if ($bonus) {
            $totalSum = $totalSum - $userBonus;
        }

        $address = $this->addressRepositories->findWhere([
                                                             'id' => $addressId,
                                                         ])->first();
        $payment = $this->paymentTypeRepository->getType($paymentTypeId);
        $time    = $this->timeDeliveryRepositories->getTimeId($timeId);
        $time    = $time->beginning_time . '-' . $time->end_time;
        $cart    = $this->cartRepositories->accept($payment->type, $address, $totalSum, $user, $comment, $time);
        $percent = $this->bonusRepositories->getPercent();
        $bonus   = [
            'bonus' => ($totalSum * ($percent->percent / 100)) + $user->bonus,
        ];
        $this->userRepository->updateProfile($bonus);

        foreach ($products as $product) {
            $this->orderRepositories->accept($cart, $product);
        }
    }


    public function history()
    {
        $carts = $this->cartRepositories->getCart();
        foreach ($carts as $cart) {
            $order        = $this->orderRepositories->find([
                                                                      OrderContract::CART_ID => $cart->id
                                                                  ])
                                                      ->first();

            $product        = $this->productRepository->getProduct($order->product_id);
            $order->product = $product;
            $cart->order    = $order;
        }

        return $carts;
    }
}
