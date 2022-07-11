<?php

namespace App\Http\Resources;

use App\Models\Category;
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
            'Category: ' . $this->food->foodCategory => [
                'id' => $this->food->id,
                'name' => $this->food->name,
                'price' => $this->food->price,
                'image' => $this->food->image,
                'ingredients' => $this->food->ingredients,

            ]
        ];

    }
}
