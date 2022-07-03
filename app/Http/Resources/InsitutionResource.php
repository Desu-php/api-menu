<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

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
            'title' => $this->title,
            'slug' => $this->slug,
            'design' => $this->design,
            'color' => $this->color_id,
            'currency' => new Collection($this->whenLoaded('currency')),
            'phone' => $this->phone,
            'logo' => $this->logo,
            'background_image' => $this->background_image,
            'wifi_password' => $this->wifi_password,
            'country' => new Collection($this->whenLoaded('country')),
            'city' => $this->city,
            'address' => $this->address,
            'epiration_date' => $this->expiration_date,
            'main_language' => $this->main_language,
        ];
    }
}
