<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActivationMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $user;
    protected $activation_link;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $activation_link)
    {
        $this->user = $user;
        $this->activation_link = $activation_link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.activation_user', ['user'=>$this->user, 'activation_link' => $this->activation_link]);
    }
}
