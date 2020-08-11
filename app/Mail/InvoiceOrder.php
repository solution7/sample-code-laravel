<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvoiceOrder extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $customer;
    public $orderRow;
    public $showDateOnInvoice;
    public $showHoursOnInvoice;
    public $invoice;
    public $countryLogo;
    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.invoice_order');
    }
}
