<?php

namespace App\Models;

use App\Models\User;
use App\Models\CartItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */ 
    protected $fillable = [
        'user_id',
    ];

    /**
     * Get the user for the cart.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the cart items for the cart.
     */
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
