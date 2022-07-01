<?php

namespace App\Http\Controllers\Api;

use App\Models\Food;
use App\Models\Restaurant;
use App\Models\WorkingHour;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\FoodResource;
use App\Http\Resources\AddressResource;
use App\Http\Resources\RestaurantResource;
use App\Http\Resources\WorkingHoursResource;
use App\Http\Resources\OpenRestaurantResource;

class RestaurantController extends Controller
{

    public function index(Request $request)
    {
        if (isset($request->is_open)) {
            $restaurants = Restaurant::all();
            return response()->json(['restaurants' => OpenRestaurantResource::collection($restaurants)]);
        }

        $restaurants = Restaurant::all();
        return response()->json(['restaurants' => RestaurantResource::collection($restaurants)]);
    }

    public function show(Restaurant $restaurant)
    {
        return response()->json([
            'restaurant' => [
                'id' => $restaurant->id,
                'name' => $restaurant->name,
                'category' => $restaurant->type,
                'phone' => $restaurant->phone,
                'address' => AddressResource::collection($restaurant->addresses),
                'schedule' => WorkingHoursResource::collection($restaurant->workingHours),
                'image' => $restaurant->image,
                "score" => $restaurant->score,
                'is_open' => $restaurant->WorkingHours->isOpen,
            ]
        ]);
    }

    public function openRestaurants(Restaurant $restaurant)
    {
        return response()->json([
            'restaurant' => [
                'id' => $restaurant->id,
                'name' => $restaurant->name,
                'category' => $restaurant->type,
                'phone' => $restaurant->phone,
                'address' => AddressResource::collection($restaurant->addresses),
                'schedule' => WorkingHoursResource::collection($restaurant->workingHours),
                'image' => $restaurant->image,
                "score" => $restaurant->score,
                'is_open' => $restaurant->WorkingHours->isOpen,
            ]
        ]);
    }

    public function restaurantFoods(Restaurant $restaurant)
    {

        $foods = $restaurant->menus;
        return response()->json(['foods' => FoodResource::collection($foods)]);
    }
}