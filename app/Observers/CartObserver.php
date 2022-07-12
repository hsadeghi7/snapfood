<?php

namespace App\Observers;

use App\Mail\SuccessfulPaymentMail;
use App\Models\Cart;
use Illuminate\Support\Facades\Mail;

class CartObserver
{

        /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;


    /**
     * Handle the Cart "created" event.
     *
     * @param  \App\Models\Cart  $cart
     * @return void
     */
    public function created(Cart $cart)
    {
//
    }

    /**
     * Handle the Cart "updated" event.
     *
     * @param  \App\Models\Cart  $cart
     * @return void
     */
    public function updated(Cart $cart)
    {
        //
    }

    /**
     * Handle the Cart "deleted" event.
     *
     * @param  \App\Models\Cart  $cart
     * @return void
     */
    public function deleted(Cart $cart)
    {
        //
    }

    /**
     * Handle the Cart "restored" event.
     *
     * @param  \App\Models\Cart  $cart
     * @return void
     */
    public function restored(Cart $cart)
    {
        //
    }

    /**
     * Handle the Cart "force deleted" event.
     *
     * @param  \App\Models\Cart  $cart
     * @return void
     */
    public function forceDeleted(Cart $cart)
    {
        //
    }


    public function pay()  
    {
        Mail::to(auth()->user())->send(new SuccessfulPaymentMail(auth()->user()));
    }
}
