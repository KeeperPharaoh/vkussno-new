<?php

namespace App\Services;

use App\Domain\Repositories\AboutCompanyRepositories;
use App\Domain\Repositories\BenefitsRepositories;
use App\Domain\Repositories\FaqRepositories;
use App\Domain\Repositories\SliderRepositories;
use Illuminate\Database\Eloquent\Collection;
use Japananimetime\Template\BaseService;

class ContentServices extends BaseService
{
    private SliderRepositories       $sliderRepositories;
    private BenefitsRepositories     $benefitsRepositories;
    private AboutCompanyRepositories $aboutCompanyRepositories;
    private FaqRepositories          $faqRepositories;

    public function __construct(
        SliderRepositories $sliderRepositories,
        BenefitsRepositories $benefitsRepositories,
        AboutCompanyRepositories $aboutCompanyRepositories,
        FaqRepositories $faqRepositories
    )
    {
        parent::__construct();
        $this->sliderRepositories       = $sliderRepositories;
        $this->benefitsRepositories     = $benefitsRepositories;
        $this->aboutCompanyRepositories = $aboutCompanyRepositories;
        $this->faqRepositories          = $faqRepositories;
    }
    public function slider(): Collection
    {
        return $this->sliderRepositories->all();
    }

    public function benefit(): Collection
    {
        return $this->benefitsRepositories->all();
    }

    public function about(): Collection
    {
        return $this->aboutCompanyRepositories->all();
    }

    public function faq(): Collection
    {
        return $this->faqRepositories->all();
    }
}
