<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderDeliveryNotification;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Request $request)
    {
        $restaurant = Restaurant::where('id', $request->restaurant_id)
            ->where('user_id', auth()->id())
            ->get();
        if ($restaurant->isEmpty() && $request->restaurant_id) {
            return abort(403);
        }

        $restaurants = Restaurant::where('user_id', auth()->id())->get();
        $orders = '';
        if ($request->restaurant_id) {
            $orders = Order::where('restaurant_id', $request->restaurant_id)
                ->where('is_archived', false)
                ->get()
                ->load('cart.cartItems.menu.food');
        }

        return view('seller.orders.index', compact('restaurants', 'orders'));
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
        $restaurant = Restaurant::where('id', $order->restaurant->id)
            ->where('user_id', auth()->id())
            ->get();
        if ($restaurant->isEmpty()) {
            return abort(403);
        }

        switch ($order->status) {
            case 'received':
                $order->status = 'accepted';
                $order->save();
                return back()->with('message', 'Order Accepted');
            case 'accepted':
                $order->status = 'pending';
                $order->save();
                return back()->with('message', 'Order Pending');
            case 'pending':
                $order->status = 'preparing';
                $order->save();
                return back()->with('message', 'Order Preparing');
            case 'preparing':
                $order->status = 'completed';
                $order->is_archived = true;
                $order->save();
                Notification::send(auth()->user(), new OrderDeliveryNotification($order));
                return redirect('seller/orders?restaurant_id=' . $order->restaurant->id)
                    ->with('message', 'Order Completed');
        }
    }
}
