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

        return
            [
                $this->category =>
                [
                    'id' => $this->id,
                    'discount' => $this->coupon . '%',
                    'foodParty' => $this->foodParty ? true : false,
                    'food_name' => $this->food->name,
                    'ingredients' => $this->food->ingredients,
                    'image' => $this->food->image,
                ]
            ];
    }
}
