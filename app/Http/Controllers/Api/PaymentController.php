<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\CartItem;
use App\Models\Restaurant;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Notifications\PaymentNotification;
use Illuminate\Support\Facades\Notification;


class PaymentController extends Controller
{
    /** 
     * Pay the Cart.
     *
     * @param  \App\Models\Restaurant  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function pay(Restaurant $restaurant)
    {

        $cart = Cart::where('user_id', auth()->id())
            ->where('restaurant_id', $restaurant->id)
            ->where('status', 'pending')
            ->first();
        if (!$cart) {
            return response()->json([
                'message' => 'Cart not found'
            ], 404);
        }
        
        $totalPrice = $cart->totalPayment($cart);
        DB::transaction(function () use ($cart, $totalPrice) {
            $cart->status = 'paid';
            $cart->save();
            $cartItemsDetails = $cart->cartItemsDetails($cart);

            Payment::create([
                'cart_id' => $cart->id,
                'total_price' => $totalPrice,
            ]);

            Order::create([
                'cart_id' => $cart->id,
                'restaurant_id' => $cart->restaurant_id,
                'status' => 'received',
            ]);
            //set CartItems price in cartItem Table
            foreach ($cartItemsDetails as  $item) {
                $cartItem = CartItem::find($item['cart_item_id']);

                $cartItem->item_price = $item['total'];
                $cartItem->save();
            }

            //send successful payment email to user
            $paymentData = [
                'totalPayment' => 'Total Payment: ' . $cart->totalPayment($cart),
                'cartItems' => $cartItemsDetails,
            ];
            Notification::send(auth()->user(), new PaymentNotification($paymentData));
        });


        // $cart->makePay();
        return response()->json([
            'message' => 'Cart Payed',
            'totalPayment' => $totalPrice
        ], 200);
    }
    //TODO Send Notification to User
}
