<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BenefitCollection extends ResourceCollection
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
            $image = $item->image;
            $image = json_decode($image);
            $image = $image[0]->download_link;
            return [
                'id'    => $item->id,
                'image' => env('APP_URL') . '/storage/' . $image,
                'description' => $item->description,
            ];
        });
    }
}
