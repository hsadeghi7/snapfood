<?php

namespace App\Http\Controllers;

use PhpParser\Comment;
use App\Models\Category;
use App\Models\Restaurant;
use App\Models\WorkingHour;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Http\Requests\UpdateRestaurantDeliveryFeeRequest;

class RestaurantController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Restaurant::class, 'restaurant');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $restaurants = Restaurant::where('user_id', auth()->id())->paginate(3);

        return view('seller.restaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
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
        $validated = $request->validated();
        $imagePath = Storage::disk('public')->put('images/restaurants/', $validated['image']);

        $restaurant = Restaurant::create(
            [
                'name' => $request->name,
                'phone' => $request->phone,
                'type' => $request->type,
                'image' => $imagePath,
                'user_id' => auth()->id(),

            ]
        );
        $restaurant->addresses()->create([
            'title' => $request->title,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect('seller/restaurants')->with('message', 'Restaurant created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return View
     */
    public function show(Restaurant $restaurant)
    {
        $comments = $restaurant
            ->with([
                'comments', 'comments.user', 'comments.replies', 'comments.replies.user'
            ])
            ->where('id', $restaurant->id)
            ->first()->comments;

        $timetable = WorkingHour::where('restaurant_id', $restaurant->id)->get();
        $week = WorkingHour::WEEK;
        return view('seller.restaurants.show', compact('restaurant', 'timetable', 'week', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return View
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
                'phone' => $request->phone,
                'type' => $request->type,
                'image' => $imagePath,
                'user_id' => auth()->id(),
            ]
        );
        $restaurant->addresses()->create([
            'title' => $request->title,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);
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
        $restaurant->menus()->delete();
        $restaurant->workingHours()->delete();
        $restaurant->addresses()->delete();
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

    public function deliveryFee(Restaurant $restaurant)
    {
        return view('seller.restaurants.delivery', compact('restaurant'));
    }
    public function setDeliveryFee(UpdateRestaurantDeliveryFeeRequest $request, Restaurant $restaurant)
    {
        $restaurant->delivery_fee = $_POST['deliveryFee'];
        $restaurant->save();

        return redirect('seller/restaurants')->with('message', 'delivery fee updated successfully');
    }
}
