<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
                'food' => $this->menu->food->name,
                'restaurant' => $this->menu->menuable->name,
                'unit_price' => $this->menu->food->price * $this->menu->coupon,
                'quantity' => $this->quantity,
                'cartItemPrice' => $this->menu->food->price * $this->menu->coupon * $this->quantity,
            ];
    }
}
