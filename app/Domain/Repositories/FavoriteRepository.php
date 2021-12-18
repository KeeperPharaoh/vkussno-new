<?php

namespace App\Domain\Repositories;

use App\Domain\Contracts\FavoriteContract;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Japananimetime\Template\BaseRepository;

class FavoriteRepository extends BaseRepository
{
    public function model(): Favorite
    {
        return new Favorite();
    }

    public function showByUserId()
    {
        return Favorite::query()
            ->where(FavoriteContract::USER_ID, Auth::id())
            ->select(FavoriteContract::PRODUCT_ID)
            ->get()
        ;
    }

    public function check(int $id)
    {
        return Favorite::query()
            ->where(FavoriteContract::USER_ID, Auth::id())
            ->where(FavoriteContract::PRODUCT_ID,$id)
            ->first()
        ;
    }

    public function deleteById(int $id)
    {
        return Favorite::query()
                        ->where(FavoriteContract::USER_ID, Auth::id())
                        ->where(FavoriteContract::PRODUCT_ID,$id)
                       ->delete()
        ;
    }
}
