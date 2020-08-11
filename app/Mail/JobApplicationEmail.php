<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class JobApplicationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;

    public $email;

    public $phone_number;

    public $subject;

    public $resume;

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
        return $this->view('emails.job_application_email')
                    ->subject($this->subject)
                    ->attach($this->resume, ['as' => 'Resume']);
    }
}
