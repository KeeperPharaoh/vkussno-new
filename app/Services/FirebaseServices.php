<?php

namespace App\Services;

use App\Domain\Repositories\UserRepository;
use Japananimetime\Template\BaseService;

class FirebaseServices extends BaseService
{
    private UserRepository $userRepository;
    protected const SEND_URL = 'https://fcm.googleapis.com/fcm/send';
    protected const SEND_METHOD = 'POST';

    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    public function test($token)
    {
        $title = 'Волк';
        $text  = 'АУФ';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,            self::SEND_URL);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,  self::SEND_METHOD);
        curl_setopt($ch, CURLOPT_HTTPHEADER,     self::getRequestHeaders());
        curl_setopt($ch, CURLOPT_POSTFIELDS,     self::getRequestBody($token, $title, $text));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_exec($ch);
        curl_close($ch);

    }


    protected static function getRequestBody($token, $title, $text)
    {
        return json_encode([
                               'to' => $token,
                               'notification' =>
                                   [
                                       'title' => $title,
                                       'body'  => $text,
                                       "sound" => "default",
                                       "badge" => 1
                                   ],
                               "priority" => "high",
                               "foreground" =>  false,
                               "userInteraction" =>  false,
                               "content_available" =>  true,
                           ]);
    }

    protected static function getRequestHeaders(): array
    {
        return [
            'Content-Type: application/json',
            'Authorization: key=' . env('FCM_SERVER_KEY'),
        ];
    }
}
