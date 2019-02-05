<?php

namespace App\Services\Payments;

class PaymentFactory
{
    public function process($type)
    {
        switch ($type) {
            case 'PagSeguro':
            return new PagSeguro;
        }
    }
}
