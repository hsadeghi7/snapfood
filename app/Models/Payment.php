<?php

namespace App\Models;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;
    protected $observables = ['payed'];

    protected $fillable = [
        'cart_id',
        'total_price',
    ];

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    
    /**
     * set the payed observer to pay method
     *
     * @return void
     */
    public function makePay()
    {
        $this->fireModelEvent('payed');
    }
}
