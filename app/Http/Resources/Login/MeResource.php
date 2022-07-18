<?php

namespace App\Http\Resources\Login;

use App\Http\Resources\Admin\Setting\LanguageStoreResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'roles' => $this->roles,
            'languages' => $this->when(!empty($this->languages), fn() => LanguageStoreResource::collection($this->languages))
        ];
    }
}
