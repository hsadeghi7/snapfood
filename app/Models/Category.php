<?php

namespace App\Models;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'type'];

    public static function getRestaurantCategories()
    {
        $categories = Category::where('type', 'restaurant')->get();
        foreach ($categories as $category) {
            $restaurant[] = $category->name;
        }
        return $restaurant;
    }
    public static function getFoodCategories()
    {
        $categories = Category::where('type', 'food')->get();
        foreach ($categories as $category) {
            $food[] = $category->name;
        }
        return $food;
    }
}
