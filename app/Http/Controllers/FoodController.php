<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Category;
use App\Http\Requests\StoreFoodRequest;
use App\Http\Requests\UpdateFoodRequest;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Food::categories();
        $items = Category::where('morphable_type', 'food')->get();

        return view('seller.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $foodCategories = Category::where('type', 'food')->get();
        return view('seller.foods.create', compact('foodCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFoodRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFoodRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function show(Food $food)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function edit(Food $food)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food $food)
    {
        //
    }
}
