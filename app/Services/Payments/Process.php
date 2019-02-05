<?php

namespace App\Services\Payments;

use App\Mail\PaymentApproved;
use Illuminate\Support\Facades\Mail;

class Process
{
    /**
     * Process an approved payment.
     *
     * @param $order Order data
     * @return void
     */
    public function approved($order)
    {
        // Verify if the cash was deliveryd
        if (!$order->wasDelivered()) {
            if ($order->user->addcash($order->user->ID, $order->package->cash)) {
                // Cash was deliveryd
                $order->delivered_at = now();
                $order->save();
                // Notify user
                Mail::to($order->user->email)->send(new PaymentApproved($order));
            }
        }
    }
}
