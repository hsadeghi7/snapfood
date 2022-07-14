<?php

namespace App\Models;

use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use App\Models\CartItem;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'restaurant_id',
    ];


    /**
     * Get the user for the cart.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user for the cart.
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    /**
     * Get the cart items for the cart.
     */
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Get the cart items for the cart.
     */ 
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * Get the order items for the cart.
     */
    public function order()
    {
        return $this->hasOne(Order::class);
    }

    /**
     * Get the total price of the cart.
     */
    public function totalPayment(Cart $cart)
    {
        $cartItems = $cart->cartItems->load('menu');
        $totalPayment = 0;
        $cartItems->each(function ($cartItem) use (&$totalPayment) {
            $totalPayment += $cartItem->menu->food->price *  (100 - $cartItem->menu->coupon) * $cartItem->quantity * 0.01;
        });
        return $totalPayment;
    }

    /**
     * Get the total details of the cart.
     */
    public function cartItemsDetails(Cart $cart)
    {
        $cartItems = $cart->cartItems->load('menu');
        $foods = [];
        foreach ($cartItems as $cartItem) {
            $foods[] =  [
                'name' => $cartItem->menu->food->name,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->menu->food->price,
                'coupon' => $cartItem->menu->coupon . '%',
                'total' => $cartItem->menu->food->price * (100 - $cartItem->menu->coupon) * $cartItem->quantity * .01,
            ];
        }
        return $foods;
    }

}
