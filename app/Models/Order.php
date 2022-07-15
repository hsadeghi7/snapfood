<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'restaurant_id',
        'cart_id',
        'is_archived',
        'status',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }


    
}
