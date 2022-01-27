<?php

namespace App\Services;
use App\Domain\Repositories\CartRepositories;
use Japananimetime\Template\BaseService;

class PaymentServices extends BaseService
{
    private CartRepositories $cartRepositories;

    public function __construct(
        CartRepositories $cartRepositories
    )
    {
        $this->cartRepositories = $cartRepositories;
    }

    public function paymentTest()
    {
            $out_sum = 100;

        // your registration data
            $mrh_login = "Vkussno.kz";
            $mrh_pass1 = "UI5MitZ9V3ISG3kPfCo0";

        // order number. "" for random value
            $inv_id = "1322";

        // urlencoded receipt
            $receipt = "%7B%22items%22:%5B%7B%22name%22:%22name%22,%22quantity%22:1,".
                "%22sum%22:11,%22tax%22:%22none%22%7D%5D%7D";

        // double urlencode for headers
            $receipt_urlencode = urlencode($receipt);

        // description of the order, if you need
            $inv_desc = "description";

        // build own CRC
            $crc = md5("$mrh_login:$out_sum:$inv_id:$receipt:$mrh_pass1");

        // payment form
           return "https://auth.robokassa.ru/Merchant/Index.aspx?MrchLogin=$mrh_login&".
             "OutSum=$out_sum&InvId=$inv_id&Receipt=$receipt_urlencode&Desc=$inv_desc&".
             "SignatureValue=$crc";
    }

    public function header()
    {

    }
}
