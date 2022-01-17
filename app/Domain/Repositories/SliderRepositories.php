<?php

namespace App\Domain\Repositories;

use App\Models\Slider;
use Prettus\Repository\Eloquent\BaseRepository;

class SliderRepositories extends BaseRepository
{
    public function model(): string
    {
        return Slider::class;
    }
}
