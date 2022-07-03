<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class MealResource extends JsonResource
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
            'category' => new Collection($this->whenLoaded('category')),
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'old_price' => $this->old_price,
            'image' => $this->image,
            'order' => $this->order,
            'weight' => $this->weight,
            'vision' => $this->vision,
            'available' => $this->available,
        ];
    }
}
