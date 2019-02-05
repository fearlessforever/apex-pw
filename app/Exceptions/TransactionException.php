<?php

namespace App\Exceptions;

use Exception;

class TransactionException extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        Log::emergency($this->getMessage());
    }
}
