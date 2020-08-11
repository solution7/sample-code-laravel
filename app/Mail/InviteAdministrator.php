<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InviteAdministrator extends Mailable
{
    use Queueable, SerializesModels;

    public $content;
    public $subject;
    public $sendTo;
    public $countryLogo;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->countryLogo = $data['countryLogo'];
        $this->subject = __('email.NewAdministratorSubject');
        $this->content = __('email.NewAdministratorMessage');

        if (!isset($data['project'])) {
            $this->content = str_replace("Project: <b>[project]</b><br><br>", '', $this->content);
        }

        if (!isset($data['company'])) {
            $this->content = str_replace("Company: <b>[company]</b><br><br>", '', $this->content);
        }

        foreach ($data as $key => $value) {
            $this->content = str_replace('['.$key.']', $value, $this->content);
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
            ->view('emails.invite_administrator');
    }
}
