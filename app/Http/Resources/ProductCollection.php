<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
            return [
                'id'             => $item->id,
                'subcategory_id' => $item->subcategory_id,
                'title'          => $item->title,
                'image'          => env('APP_URL') . '/storage/' . $item->image,
                'price'          => $item->price,
                'old_price'      => $item->old_price
            ];
        });
    }
}
