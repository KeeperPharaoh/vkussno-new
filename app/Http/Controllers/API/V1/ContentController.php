<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Services\ContentServices;
use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;
class ContentController extends BaseController
{
    public ContentServices $contentServices;

    public function __construct(ContentServices $contentServices)
    {
        $this->contentServices = $contentServices;
    }

    public function slider(): JsonResponse
    {
        $result = $this->contentServices->slider();
        return $this->sendResponse($result);
    }

    public function benefit()
    {
        $result = $this->contentServices->benefit();
        return $this->sendResponse($result);
    }

    public function about()
    {
        $result = $this->contentServices->about();
        return $this->sendResponse($result);
    }

    public function faq()
    {
        $result = $this->contentServices->faq();
        return $this->sendResponse($result);
    }
}
