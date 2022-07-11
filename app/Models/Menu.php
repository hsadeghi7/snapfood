<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'food_id',
        'coupon',
        'foodParty',
        'menu_id',
        'menu_type',
    ];

    public function menuable()
    {
        return $this->morphTo();
    }

    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    // public function carts()
    // {
    //     return $this->belongsToMany(Cart::class);
    // }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }


    // public function getMenuPriceAttribute()
    // {
    //     return $this->food->price * $this->coupon;
    // }

}
