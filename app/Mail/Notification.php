<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Notification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $content;
    public $subject;
    public $countryLogo;

    public function __construct($data, $emailData)
    {
        $message = $emailData['content'];
        foreach ($data as $key => $value) {
            $message = str_replace("[$key]", $value, $message);
        }

        $this->content = $message;
        $this->subject = $emailData['subject'];
        $this->countryLogo = $data['countryLogo'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->view('emails.notification');
    }
}
