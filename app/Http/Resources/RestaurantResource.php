<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
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
            'name' => $this->name,
            'category' => $this->type,
            'phone' => $this->phone,
            'address' => AddressResource::collection($this->first()->addresses),
            'schedule' => WorkingHoursResource::collection($this->workingHours),
            'image' => $this->image,
            "score" => $this->score,
            'is_open'=> $this->isOpen,
        ];
    }
}
