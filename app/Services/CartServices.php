<?php /** @noinspection PhpUndefinedVariableInspection */

namespace App\Services;

use App\Domain\Contracts\CityContract;
use App\Domain\Contracts\OrderContract;
use App\Domain\Contracts\TimeOfDeliveryContract;
use App\Domain\Repositories\AddressRepositories;
use App\Domain\Repositories\BonusRepositories;
use App\Domain\Repositories\CartRepositories;
use App\Domain\Repositories\CityRepositories;
use App\Domain\Repositories\OrderRepositories;
use App\Domain\Repositories\OrderStatusRepositories;
use App\Domain\Repositories\PaymentTypeRepository;
use App\Domain\Repositories\ProductRepository;
use App\Domain\Repositories\PromoRepositories;
use App\Domain\Repositories\TimeDeliveryRepositories;
use App\Domain\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Japananimetime\Template\BaseService;
use Prettus\Validator\Exceptions\ValidatorException;

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
    private CityRepositories $cityRepositories;
    private OrderStatusRepositories  $orderStatusRepositories;

    public function __construct(
        CartRepositories         $cartRepositories,
        ProductRepository        $productRepository,
        TimeDeliveryRepositories $timeDeliveryRepositories,
        PaymentTypeRepository    $paymentTypeRepository,
        UserRepository           $userRepository,
        AddressRepositories      $addressRepositories,
        PromoRepositories        $promoRepositories,
        BonusRepositories        $bonusRepositories,
        OrderRepositories        $orderRepositories,
        CityRepositories         $cityRepositories,
        OrderStatusRepositories  $orderStatusRepositories
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
        $this->cityRepositories         = $cityRepositories;
        $this->orderStatusRepositories  = $orderStatusRepositories;
    }

    /** @noinspection PhpUndefinedFieldInspection */
    public function accept($attributes): JsonResponse
    {
        $addressId     = $attributes['address'];
        $products      = $attributes['data'];
        $sum           = 0;
        $bonus         = $attributes['bonus'];
        $paymentTypeId = $attributes['payment_type'];
        $comment       = $attributes['comment'];
        $timeId        = $attributes['delivery_time'];
        $user          = Auth::user();
        $userBonus     = $user->bonus;
        $city          = $user->city;

        $time = $this->timeDeliveryRepositories->findWhere([
                                                               'id' => $timeId,
                                                           ])
                                               ->first();
        $counterTime = $time->counter;
        $time        = $time->beginning_time . '-' . $time->end_time;

        foreach ($products as $product) {
            $productPrice = $this->productRepository->findWhere([
                                                                    'id' => $product['id'],
                                                                ])
                                                    ->first();
            $sum          += $productPrice->price * $product['quantity'];
        }

        if ($bonus) {
            $totalSum = $sum - $userBonus;
            if ($totalSum < 0) {
                $totalSum       = 0;
                $succulentBonus = $userBonus - $sum;
            } else {
                $succulentBonus = 0;
            }
            try {
                DB::beginTransaction();
                $bonusUser = $this->userRepository->update([
                                                               'bonus' => $succulentBonus,
                                                           ], Auth::id());
                $bonusUser = $bonusUser->bonus;
            } catch (ValidatorException $exception) {
                DB::rollBack();

                return response()->json([
                                            'success' => false,
                                            'message' => $exception->getMessage(),
                                        ], 418);
            }
            DB::commit();
        } else {
            $bonusUser = $bonus;
            $totalSum  = $sum;
        }

        $address = $this->addressRepositories->findWhere([
                                                             'id' => $addressId,
                                                         ])
                                             ->first();

        $payment = $this->paymentTypeRepository->findWhere([
                                                               'id' => $paymentTypeId,
                                                           ])
                                               ->first();


        $freeDeliveryPrice = $this->cityRepositories->findWhere([
                                                                    CityContract::CITY => $city,
                                                                ])
                                                    ->first();

        if ($sum < $freeDeliveryPrice->free) {
            $totalSum += $freeDeliveryPrice->price;
        }

        $percent = $this->bonusRepositories->getPercent();

        $bonus = [
            'bonus' => ($sum * ($percent->percent / 100)) + $bonusUser,
        ];

        try {
            DB::beginTransaction();
            $this->userRepository->update(['bonus' => $bonus['bonus']], Auth::id());
        } catch (ValidatorException $exception) {
            DB::rollBack();

            return response()->json([
                                        'success' => false,
                                        'message' => $exception->getMessage(),
                                    ], 418);
        }
        DB::commit();

        $orderStatus = $this->orderStatusRepositories->first();

        DB::beginTransaction();
        $cart = $this->cartRepositories->accept($payment, $address, $totalSum, $user, $comment, $time, $city, $orderStatus->id);
        DB::commit();

        foreach ($products as $product) {
            $this->orderRepositories->accept($cart, $product);
        }

        try {
            $this->timeDeliveryRepositories->update([
                                                        TimeOfDeliveryContract::COUNTER => $counterTime + 1,
                                                    ], $timeId);
        } catch (ValidatorException $exception) {
            return response()->json([
                                        'success' => false,
                                        'message' => $exception->getMessage(),
                                    ], 418);
        }

        return response()->json([
                                    'success' => true,
                                    'message' => 'Операция прошла успешно',
                                ], 200);
    }


    public function history()
    {
        $carts    = $this->cartRepositories->getCart();
        $products = [];
        foreach ($carts as $cart) {
            $orders = $this->orderRepositories->findWhere([
                                                              OrderContract::CART_ID => $cart->id,
                                                          ]);
            foreach ($orders as $order) {
                $product        = $this->productRepository->findWhere([
                                                                          'id' => $order->product_id,
                                                                      ])
                                                          ->first();
                $product->image = env('APP_URL') . '/storage/' . $product->image;
                $product->quantity = $order->quantity;
                $products[]     = $product;
            }
            $cart->order = $products;
            $products    = [];
        }
        return $carts;
    }
}
