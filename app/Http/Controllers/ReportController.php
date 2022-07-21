<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Requests\ShowDataRequest;
use App\Http\Requests\StoreReportRequest;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $restaurants = Restaurant::where('user_id', auth()->id())->get();
        return view('seller.reports.index', compact('restaurants'));
    }

    /**
     * Display the specified resource.
     *
     * @param  ShowDataRequest  $request
     * @return View
     */
    public function showData(ShowDataRequest $request)
    {
        $restaurant = Restaurant::where('id', $request->restaurant_id)
            ->where('user_id', auth()->id());
        if (!$restaurant) {
            return abort('unAuthorize', 403);
        }

        $timePeriod = time() - $request->time_period * 24 * 60 * 60;
        $timePeriod = date("Y-m-d H:i:s", $timePeriod);
        $orders = Order::where('restaurant_id', $request->restaurant_id)
            ->where('is_archived', true)
            ->where('created_at', '>', $timePeriod)
            ->with('cart', 'cart.cartItems', 'cart.cartItems.menu', 'cart.cartItems.menu.food', 'cart.user')
            ->get();

            $restaurants = Restaurant::where('user_id', auth()->id())->get();
        return view('seller.reports.index', compact('restaurants', 'orders'));
    }
}
