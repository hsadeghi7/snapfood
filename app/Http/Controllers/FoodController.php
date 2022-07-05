<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Coupon;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreFoodRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateFoodRequest;

class FoodController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Food::class, 'food');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foods = DB::table('foods')->where('user_id', auth()->id())->paginate(3);

        //food names
        $food_names = DB::table('foods')->where('user_id', auth()->id())->pluck('name');
        //food category
        $food_categories = DB::table('foods')->where('user_id', auth()->id())->pluck('foodCategory');

        return view('seller.foods.index', compact('foods', 'food_names', 'food_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $foodCategories = Category::where('type', 'food')->get();
        $coupons = Coupon::get();
        return view('seller.foods.create', compact('foodCategories', 'coupons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFoodRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFoodRequest $request)
    {
        $validated = $request->validated();
        $imagePath = Storage::disk('public')->put('images/foods/', $validated['image']);
        Food::create(
            [
                'name' => $request->name,
                'price' => $request->price,
                'ingredients' => $request->ingredients,
                'foodCategory' => $request->foodCategory,
                'image' => $imagePath,
                'user_id' => auth()->id(),
            ]
        );

        return redirect('seller/foods')->with('message', 'Food created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function show(Food $food)
    {
        dd($food);
        // $timetable = WorkingHour::where('restaurant_id', $food->id)->get();
        // $week = WorkingHour::WEEK;
        // return view('seller.restaurants.show', compact('food', 'timetable', 'week'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function edit(Food $food)
    {
        $foodCategories = Category::where('type', 'food')->get();
        $coupons = Coupon::get();
        return view('seller.foods.edit', compact('food', 'foodCategories', 'coupons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFoodRequest  $request
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFoodRequest $request, Food $food)
    {
        $validated = $request->validated();
        $imagePath = $food->image;
        if ($request->image) {
            $imagePath = Storage::disk('public')->put('images/foods/', $validated['image']);
        }
        $food->update(
            [
                'name' => $request->name,
                'price' => $request->price,
                'ingredients' => $request->ingredients,
                'foodCategory' => $request->foodCategory,
                'image' => $imagePath,
                'user_id' => auth()->id(),
            ]
        );
        return redirect('seller/foods')->with('message', 'Food updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food $food)
    {
        $food->delete();
        return back()->with('message', "$food->name deleted updated successfully");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function statusToggle()
    {
        $food = Food::find($_POST['id']);

        if ($food->foodParty) {
            $food->foodParty = false;
        } else {
            $food->foodParty = true;
        }

        $food->save();

        return back()->with('message', 'Food Party status updated successfully for ' . $food->name);
    }


    public function getCategories()
    {
        // dd($_POST);
        $food_categories = Food::select('*')->where('foodCategory', $_POST['food_category'])->get();
        return response()->json('$food_categories');
    }

}
