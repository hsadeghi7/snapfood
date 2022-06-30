<?php

namespace App\Http\Controllers;


use App\Models\Menu;
use App\Models\Coupon;
use App\Models\Restaurant;
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
        // dd($restaurant->menus->load('food'));

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
        $restaurant = Restaurant::find(request('restaurant_id'));
        $menu = new Menu();
        $menu->coupon = request('coupon');
        $menu->food_id = request('food_id');

        $restaurant->menus()->save($menu);
        return back()->with('message', 'Menu created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $restaurant = Restaurant::where('id', $id)->first();
        $restaurantFoods = $restaurant->menus->load('food');
        $allFood = auth()->user()->foods;
        $coupons = Coupon::all();

        return view('seller.menus.create', compact('restaurant', 'allFood', 'coupons', 'restaurantFoods'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
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
        $menu->foodParty = true;
        $menu->save();
        return  back()->with('message', 'Menu updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        Menu::destroy($menu->id);
        return back()->with('message', 'Food removed from menu successfully');
    }
}
