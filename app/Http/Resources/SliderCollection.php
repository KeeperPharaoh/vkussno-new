<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SliderCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
            return [
                'id'        => $item->id,
                'title'     => $item->title,
                'subtitle'  => $item->subtitle,
                'price'     => $item->price,
                'old_price' => $item->old_price,
                'image'     => env('APP_URL') . '/storage/' . $item->image,
            ];
        });
    }
}
