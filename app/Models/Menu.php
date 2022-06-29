<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'restaurant_id',
        'food_id',
        'user_id',
        'coupon',
        'foodParty'
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function foods()
    {
        return $this->belongsToMany(Food::class);
    }
    
}
