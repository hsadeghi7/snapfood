<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Menu;
use App\Models\User;
use App\Models\Coupon;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
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
     * @return View
     */
    public function index(Request $request)
    {
        $foods = Food::where('user_id', auth()->id())->paginate(3);

        if ($request->has('food_category') && $request->food_category != 'all') {
            $foods = Food::where('user_id', auth()->id())
                ->where('foodCategory', $request->food_category)
                ->paginate(3);
        }
        //TODO توی صفحه بندی وقتی صفحه رفرش میشه دسته بندی ها دوباره بهم میخوره چکار کنیم که با رفرش شدن صفحه بازم اون دسته بندی قبلی برقرار باشه؟
        //food names
        $food_names =  Food::where('user_id', auth()->id())->pluck('name');
        //food category
        $food_categories = Food::where('user_id', auth()->id())->pluck('foodCategory')->unique();

        return view('seller.foods.index', compact('foods', 'food_names', 'food_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
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
        //TODO بردن عکس ها روی سرورهای ابری

        $imagePath = Storage::disk('public')->put('/', $request->image);
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
     * @return View
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
        Menu::where('food_id', $food->id)->delete();
        $food->menus()->delete();
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

}
