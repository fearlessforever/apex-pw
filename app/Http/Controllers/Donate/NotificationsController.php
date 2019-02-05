<?php

namespace App\Http\Controllers\Donate;

header('access-control-allow-origin: https://sandbox.pagseguro.uol.com.br');

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PaymentGateway;
use App\Exceptions\InvalidPaymentGateway;

class NotificationsController extends Controller
{
    /**
     * This method is responsible to handle payment gateway notifications (IPN)
     */
    public function notification(Request $request)
    {
        $paymentGateway = PaymentGateway::bySlug($request->gateway)->findOrFail(function () use (&$request) {
            throw new InvalidPaymentGateway("Invalid Payment Gateway [{$request->gateway}]", 400);
        });

        return $paymentGateway->payment()->notification($request);
    }
}
