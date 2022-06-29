<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Restaurant extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'phone',
        'type',
        'image',
        'user_id',
        'is_active',
        'latitude',
        'longitude',
    ];


    /**
     * Get all of the category for the restaurant and food.
     */
    public function categories()
    {

        return $this->morphToMany(Category::class, 'categorizeable');
    }


    /**
     * Get all of the address for the restaurant.
     */

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    
    /**
     * .
     */
    public function workingHours()
    {
        return $this->hasMany(WorkingHour::class);
    }

    /**
     * Get all of the restaurant for the user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the menu for the restaurant.
     */
    // public function menus()
    // {
    //     return $this->hasMany(Menu::class);
    // }

    public function foods()
    {
        return $this->hasMany(Food::class);
    }
}
