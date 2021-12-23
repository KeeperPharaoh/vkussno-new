<?php

namespace App\Domain\Repositories;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Model;
use Japananimetime\Template\BaseRepository;

class SliderRepositories extends BaseRepository
{
    public function model(): Slider
    {
       return new Slider();
    }
}
