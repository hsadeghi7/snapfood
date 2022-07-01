<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
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
            'id' => $this->food->id,
            'title' => $this->food->name,
            'category' => $this->food->foodCategory,
            'price' => $this->food->price,
            'image' => $this->food->image,
            'raw_material' => $this->food->ingredients,
        ];
    }
}
