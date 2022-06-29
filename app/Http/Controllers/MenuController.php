<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Menu;
use App\Models\Coupon;
use App\Models\Restaurant;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = auth()->user()->restaurants;
        $foods = auth()->user()->foods;
        $menus = auth()->user()->menus;
        // dd($restaurants->first()->menu->name);
        return view('seller.menus.index', compact('restaurants', 'foods', 'menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurants = auth()->user()->restaurants;
        $foods = auth()->user()->foods;
        $coupons = Coupon::all();
        return view('seller.menus.create', compact('restaurants', 'foods', 'coupons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMenuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenuRequest $request)
    {
        $restaurant = Restaurant::find($request->restaurant_id);
        $food = Food::find($request->food_id);

        if (!DB::table('food_restaurant')
            ->where([
                ['food_id', $request->food_id],
                ['restaurant_id', $request->restaurant_id]
            ])
            ->exists()) {

            $restaurant->foods()->save($food);
            return redirect('seller/menus')->with('message', 'Menu created successfully');
        }
        return redirect('seller/menus')->with('message', 'Food already exists in this restaurant');


        // dd($food->restaurant()->get());
        // dd($food);
        // $menu = Menu::create($request->all());
        // dd(Food::find($request->food_id));
        // return back()->with('message', 'Food add to menu successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        dd($menu->food);
        $foods = auth()->user()->foods;
        $menus = $menu->restaurant->menus;
        $restaurant = $menu->restaurant;
        return view('seller.menus.show', compact('menus', 'foods', 'restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        dd($menu);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMenuRequest  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {

        $restaurant_id = $_POST['restaurant_id'];
        $food_id = $_POST['food_id'];

        $restaurant = Restaurant::find($restaurant_id);
        $restaurant->foods()->detach($food_id);

        return redirect('seller/menus')->with('message', 'Food removed from menu successfully');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showMenu()
    {
        // dd($_POST);
        $id = json_decode($_POST['restaurant'])->id;
        $restaurant = Restaurant::where('id', $id)->first();

        $allFood = auth()->user()->foods;
        $coupons = Coupon::all();

        return view('seller.menus.create', compact('restaurant', 'allFood', 'coupons'));
    }
}
