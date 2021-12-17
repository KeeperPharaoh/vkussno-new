<?php

namespace App\Services;

use App\Domain\Repositories\ContentRepositories;
use App\Models\AboutCompany;
use App\Models\Benefits;
use App\Models\Faq;
use App\Models\Slider;
use Japananimetime\Template\BaseService;

class ContentServices extends BaseService
{
//    public ContentRepositories $contentRepositories;
//
//    public function __construct(ContentRepositories $contentRepositories)
//    {
//        $this->contentRepositories = $contentRepositories;
//    }

    public function slider()
    {
        return Slider::all();
    }

    public function benefit()
    {
        return Benefits::all();
    }

    public function about()
    {
        return AboutCompany::all();
    }

    public function faq()
    {
        return Faq::all();
    }
}
