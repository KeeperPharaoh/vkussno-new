<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
            return [
                'id'    => $item->id,
                'image' => env('APP_URL') . '/storage/' . $item->image,
                'title' => $item->title,
                'count' => $item->count
            ];
        });
    }
}
