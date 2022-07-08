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
            ['cartItem ' . $this->carts[0]->id =>  [
                'food' => $this->food->name,
                'restaurant' => $this->menuable->name,
                'price' => $this->food->price * $this->coupon,
                'quantity' => $this->carts[0]->quantity,
                'cartItemPrice' => $this->food->price * $this->coupon * $this->carts[0]->quantity,
            ]];
    }
}
