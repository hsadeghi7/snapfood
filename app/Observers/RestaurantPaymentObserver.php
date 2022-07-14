<?php

namespace App\Observers;

use App\Models\Cart;
use App\Models\Restaurant;
use App\Notifications\PaymentNotification;
use Illuminate\Support\Facades\Notification;

class RestaurantPaymentObserver
{
    public function payed(Restaurant $restaurant)
    {
        $cart = Cart::where('user_id', auth()->id())
            ->where('restaurant_id', $restaurant->id)
            ->where('status', 'paid')
            ->last();
        if (!$cart) {
            return;
        }

        $paymentData = [
            'totalPayment' => 'Total Payment: ' . $cart->totalPayment($cart),
            'cartItems' => $cart->cartItemsDetails($cart),
        ];
        Notification::send(auth()->user(), new PaymentNotification($paymentData));
    }

}
