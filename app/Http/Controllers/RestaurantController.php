<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Restaurant;
use App\Models\WorkingHour;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use Illuminate\Support\Facades\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::paginate(5);
        return view('seller.restaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurantCategories = Category::getRestaurantCategories();

        return view('seller.restaurants.create', compact('restaurantCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRestaurantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRestaurantRequest $request)
    {
        // dd($request->all());
        $validated = $request->validated();
        $imagePath = Storage::disk('public')->put('images/restaurants/', $validated['image']);
        Restaurant::create(
            [
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'type' => $request->type,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'image' => $imagePath,
                'user_id' => auth()->id(),
                // 'categoryable_type'=>'food',
                // 'categoryable_id'=>'8'
            ]
        );
        return redirect('/')->with('message', 'Restaurant created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        // dd($restaurant);
        $timetable = WorkingHour::where('restaurant_id', $restaurant->id)->get();
        $week = WorkingHour::WEEK;
        return view('seller.restaurants.show', compact('restaurant', 'timetable', 'week'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        //    dd($restaurant);
        $restaurantCategories = Category::getRestaurantCategories();

        return view('seller.restaurants.edit', compact('restaurant', 'restaurantCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRestaurantRequest  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant)
    {
        $validated = $request->validated();
        $imagePath = $restaurant->image;
        if ($request->image) {
            $imagePath = Storage::disk('public')->put('images/restaurants/', $validated['image']);
        }
        $restaurant->update(
            [
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'type' => $request->type,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'image' => $imagePath,
                'user_id' => auth()->id(),
            ]
        );
        return redirect('/')->with('message', 'Restaurant updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return back()->with('message', 'Restaurant deleted successfully');
    }


    public function statusToggle()
    {
        $restaurant = Restaurant::find($_POST['id']);

        if ($restaurant->is_active) {
            $restaurant->is_active = false;
        } else {
            $restaurant->is_active = true;
        }

        $restaurant->save();

        return back()->with('message', 'Restaurant status updated successfully');
    }
}
