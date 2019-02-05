<?php

namespace App\Services\Payments;

use App\Donate;
use Illuminate\Support\Facades\Log;
use Facades\App\Services\Payments\Process;
use Exception;
use App\Exceptions\InvalidTransaction;

class PagSeguro
{
    const PAYMENT_APPROVED = 3;
    const PAYMENT_DISPUTE = 5;
    const PAYMENT_REFUNDED = 6;
    const PAYMENT_CANCELLED = 7;
    const PAYMENT_CHARGED = 8;
    const PAYMENT_TEMPORARY_RETENTION = 9;

    public function __construct()
    {
        \PagSeguro\Library::initialize();
        \PagSeguro\Configuration\Configure::setEnvironment('sandbox');
        \PagSeguro\Configuration\Configure::setAccountCredentials(
            config('services.pagseguro.email'),
            config('services.pagseguro.token')
        );
    }

    /**
     * Creates the transaction on PagSeguro
     */
    public function create($order) : string
    {
        $payment = new \PagSeguro\Domains\Requests\Payment();
        $payment->addItems()->withParameters(
            $order->package->id,
            "Pacote {$order->package->cash} GOLDs",
            1,
            (float) $order->package->price
        );
        $payment->setCurrency('BRL');
        $payment->setReference((string)$order->transaction_reference);
        $payment->setSender()->setName(auth()->user()->truename);
        $payment->setSender()->setEmail(auth()->user()->email);
        $payment->setShipping()->setAddressRequired()->withParameters('FALSE');

        try {
            $paymentUrl = $payment->register(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );
            return $paymentUrl;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Handle PagSeguro's Notification (IPN)
     *
     * @param Illuminate\Http\Request $data The request data from PagSeguro POST.
     * @return void
     */
    public function notification($data)
    {
        try {
            if (\PagSeguro\Helpers\Xhr::hasPost()) {
                $data = \PagSeguro\Services\Transactions\Notification::check(
                    \PagSeguro\Configuration\Configure::getAccountCredentials()
                );
            } else {
                echo 'InvalidArgumentException';
            }

            $order = Donate::byReference($reference)->findOrFail(function () use (&$reference) {
                throw new InvalidTransaction("[PagSeguro] Transaction ($reference) Not Found.");
            });

            $order->forceFill([
                'transaction_status' => $data->getStatus(),
                'transaction_code' => $data->getCode(),
                'paid_at' => now()
            ])->save();

            if ($order->transaction_status == self::PAYMENT_APPROVED) {
                Process::approved($order);
            }
        } catch (Exception $e) {
            Log::error("PagSeguro's IPN Error: $e->getMessage() [$e->getCode()]");
            return false;
        }
    }
}
