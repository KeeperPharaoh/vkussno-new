<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\AcceptCartRequest;
use App\Services\CartServices;
use App\Services\FirebaseServices;
use App\Services\PaymentServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends BaseController
{

    public CartServices $cartServices;
    public FirebaseServices $firebaseServices;
    public PaymentServices $paymentServices;

    public function __construct(
        CartServices     $cartServices,
        FirebaseServices $firebaseServices,
        PaymentServices  $paymentServices
    ) {
        $this->cartServices     = $cartServices;
        $this->firebaseServices = $firebaseServices;
        $this->paymentServices  = $paymentServices;
    }

    public function accept(AcceptCartRequest $request): JsonResponse
    {
        $request = $request->validated();

        return $this->cartServices->accept($request);
    }

    public function history(): JsonResponse
    {
        $data = $this->cartServices->history();

        return $this->sendResponse($data);
    }

    public function test(): JsonResponse
    {
        $token = 'dVv8ePuAC08lp2PIPuYOoV:APA91bHJ8Mtp8ZLNF-SQBdYeH0eHVMpVMLPE3EfIYT8f3pamLyNrn7lTBAyQDmuB693q7262CUKUpKMhZkwrjzree8G4Swqq1jXgaLix0FcYwUQlGjG7BUdAe51jgM_p5FrLdoRVADc0';
        $this->firebaseServices->test($token);
        $tokenAnd = 'dVYvuQR1R96SXZkh8347ZY:APA91bHdta_VSccf8WRNaRMdMPr4IvwvxAXHajocCFz2SOKHERgXN1CtjyTJcVvrKj7to585gwcRB1G2MxVfkW6lTwqx_elY7B_BnTxjdTj7E0NTav-YAWU5SFhk57RtMwgXhrTNrTrA';
        $this->firebaseServices->test($tokenAnd);

        return $this->sendSuccessMessage();
    }

    public function paymentTest()
    {
        return $this->paymentServices->paymentTest();
    }
}
