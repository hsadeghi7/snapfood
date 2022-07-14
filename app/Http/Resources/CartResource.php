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
                'id' => $this->id,
                'food' => $this->menu->food->name,
                'restaurant' => $this->menu->menuable->name,
                'unit_price' => $this->menu->food->price * (100-$this->menu->coupon)*0.01,
                'quantity' => $this->quantity,
                'cartItemPrice' => $this->menu->food->price * (100-$this->menu->coupon) * $this->quantity*0.01,
            ];
    }
}
