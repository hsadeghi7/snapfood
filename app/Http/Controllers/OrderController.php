<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Cart;
use App\Models\Payment;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Request $request)
    {
        $restaurants = Restaurant::where('user_id', auth()->id())->get();
        $orders = '';
        if ($request->restaurant_id) {
            $orders = Order::where('restaurant_id', $request->restaurant_id)
                ->where('is_archived', false)
                ->get()
                ->load('cart.cartItems.menu.food');
        }
        // return $orders->first()->cart->cartItems->first()->menu->food->name;
        return view('seller.orders.index', compact('restaurants', 'orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $items = $order->load('cart.cartItems.menu.food')->cart->cartItems;
        // return $items;
        return view('seller.orders.show', compact('items'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return 
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        if ($order->status == 'received') {
            $order->status = 'accepted';
            $order->save();
            return back()->with('success', 'Order Accepted');
        }
        if ($order->status == 'accepted') {
            $order->status = 'pending';
            $order->save();
            return back()->with('success', 'Order Pending');
        }
        if ($order->status == 'pending') {
            $order->status = 'preparing';
            $order->save();
            return back()->with('success', 'Order Preparing');
        }
        if ($order->status == 'preparing') {
            $order->status = 'completed';
            $order->is_archived = true;
            $order->save();
            return back()->with('success', 'Order Completed');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
