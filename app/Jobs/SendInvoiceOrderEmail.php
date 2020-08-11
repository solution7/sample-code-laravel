<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Mail\InvoiceOrder;
use App\Models\Order;
use App\Models\CountrySetting;

use Mail;

class SendInvoiceOrderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    protected $order;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $defaultLogo = CountrySetting::getOne('DEFAULT_LOGO') ?? 'default';
        $countryLogo = '/assets/images/logos/logo-'.$defaultLogo.'.png';

        $this->data = [
            'countryLogo' => $countryLogo,
            'order' => $this->order,
            'customer' => $this->order->customer,
            'sendTo' => $this->order->customer->email,
        ];

        $email = new InvoiceOrder($this->data);
        $to = $this->data['sendTo'];
        Mail::to($to)->send($email);
    }
}
