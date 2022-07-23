<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InsitutionResource extends JsonResource
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
            'id' => $this->id,
            'user_id' => $this->user_id,
            'city' => new CityResource($this->whenLoaded('city')),
            'name' => $this->getTranslations('name'),
            'slug' => $this->slug,
            'design' => $this->design,
            'color' => $this->color_id,
            'currency' => new CurrencyResource($this->whenLoaded('currency')),
            'phone' => $this->phone,
            'logo' => $this->logo ? asset($this->logo) : null,
            'background_image' => $this->background_image,
            'wifi_password' => $this->wifi_password,
            'country' => new CountryResource($this->whenLoaded('country')),
            'address' => $this->address,
            'user' => new UserResource($this->whenLoaded('user'))
        ];
    }
}
