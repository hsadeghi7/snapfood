<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Comment;
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
        'score',
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
     * Get all of the menus-items for the restaurant.
     */
    public function menus()
    {
        return $this->morphMany(Menu::class, 'menuable');
    }

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


    public function foods()
    {
        return $this->hasMany(Food::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function getIsOpenAttribute()
    {
        $isOpen = false;
        $now = now();
        foreach ($this->workingHours as $workingHour) {
            if (strtolower(date('D', time())) == strtolower(substr($workingHour->day, 0, 3))) {
                $openTime = $workingHour->open_time;
                $closeTime = $workingHour->close_time;

                if ($now->hour >= $openTime && $now->hour < $closeTime) {
                    $isOpen = true;
                }
            }
        }

        return $isOpen;
    }
    public  function nearestRestaurant(int $nearestDistant)
    {
        $user_address = User::where('id', 4)
            ->first()->addresses->where('is_default', true)->first();

        $flag = false;
        $latRestaurant = $this->addresses->first()->latitude;
        $lngRestaurant = $this->addresses->first()->longitude;

        $latUser = $user_address->latitude;
        $lngUser = $user_address->longitude;

        $distance = pow(pow(($latRestaurant - $latUser), 2) + pow(($lngRestaurant - $lngUser), 2), 0.5);

        if ($distance < $nearestDistant) {
            $flag = true;
        }
        return $flag;
    }
}
