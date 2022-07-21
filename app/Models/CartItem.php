<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItem extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cart_id',
        'menu_id',
        'quantity',
        'items_price',
        'item_price'
    ];

    /**
     * Get the cart for the cart item.
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * Get the menu for the cart item.
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

   
    /**
     * Get the restaurant of the cart item.
     */
    public function cartItemRestaurant()  
    {
        return $this->load('menu')->menu->load('menuable')->menuable->id;
    }
}
