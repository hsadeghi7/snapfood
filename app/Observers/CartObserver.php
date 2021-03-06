<?php

namespace App\Observers;

use App\Models\Cart;
use App\Mail\SuccessfulPaymentMail;
use Illuminate\Support\Facades\Mail;
use App\Notifications\PaymentNotification;
use Illuminate\Support\Facades\Notification;

class CartObserver
{

        /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;


    public function payed(Cart $cart)
    {
        $paymentData = [
            'totalPayment' => 'Total Payment: ' . $cart->totalPayment($cart),
            'cartItems' => $cart->cartItemsDetails($cart),
        ];
        Notification::send(auth()->user(), new PaymentNotification($paymentData));
    }

}
