<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
