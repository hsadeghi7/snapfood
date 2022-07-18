<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Jobs\DeliveredNotificationJob;
use App\Http\Requests\StoreOrderRequest;
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
        // return $orders->first()->cart->cartItems->first()->menu->food->name;
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

        if ($order->status == 'received') {
            $order->status = 'accepted';
            $order->save();
            return back()->with('message', 'Order Accepted');
        }
        if ($order->status == 'accepted') {
            $order->status = 'pending';
            $order->save();
            return back()->with('message', 'Order Pending');
        }
        if ($order->status == 'pending') {
            $order->status = 'preparing';
            $order->save();
            return back()->with('message', 'Order Preparing');
        }
        if ($order->status == 'preparing') {
            $order->status = 'completed';
            $order->is_archived = true;
            $order->save();

            //send notification to user
            Notification::send(auth()->user(), new OrderDeliveryNotification($this->order));
            return redirect('seller/orders?restaurant_id=' . $order->restaurant->id)
                ->with('message', 'Order Completed');
        }
    }
}
