<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SuccessfulPaymentMail extends Mailable 
{
    use Queueable, SerializesModels;
    
    protected $paymentData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($paymentData)
    {
        $this->paymentData = $paymentData;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.successful-payment-mail')->with('paymentData', $this->paymentData);
    }
}
