<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserActivation extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public $email;

    public $name;

    public $link;

    public $countryLogo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        foreach ($data as $key => $object) {
            $this->$key = $object;
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->email, $this->name)->view('emails.registration_email');
    }
}
