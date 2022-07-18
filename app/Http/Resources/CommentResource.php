<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'author' => $this->user->name,
            'foods' => CartItemResource::collection($this->cart->cartItems),
            'score' => $this->score,
            'content' => $this->body,
            'created_at'=> $this->created_at
        ];
    }
}
