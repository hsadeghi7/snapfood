<?php

namespace App\Models;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'type'];

    /**
     * Get all of the foods that are assigned this tag.
     */
    public function foods()
    {
        return $this->morphedByMany(Food::class, 'categorizeable');
    }

    /**
     * Get all of the restaurants that are assigned this tag.
     */
    public function restaurants()
    {
        return $this->morphedByMany(Restaurant::class, 'categorizeable');
    }


    public static function getRestaurantCategories()
    {
        $categories = Category::where('type', 'restaurant')->get();
        foreach ($categories as $category) {
            $restaurant[] = $category->name;
        }
        return $restaurant;
    }
}
