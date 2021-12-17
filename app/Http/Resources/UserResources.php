<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property integer $id
 * @property string  $name
 * @property mixed   $email
 * @property mixed   $phone
 * @property mixed   $city
 * @property mixed   $language
 * @property mixed   $bonus
 */
class UserResources extends JsonResource
{


    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'       => $this->id,
            'name'     => $this->name,
            'email'    => $this->email,
            'phone'    => $this->phone,
            'city'     => $this->city,
            'language' => $this->language,
            'bonus'    => $this->bonus
        ];
    }
}
