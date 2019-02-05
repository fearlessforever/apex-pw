<?php

namespace App\Mail;

use App\Donate;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentApproved extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Donate data.
     */
    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Donate $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = sprintf('[%s] %s', config('app.name'), 'Pagamento aprovado!');

        return $this->subject($subject)->markdown('emails.payments.approved');
    }
}
