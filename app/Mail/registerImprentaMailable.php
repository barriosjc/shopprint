<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class registerImprentaMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $user = null;
    public $cliente = null;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $cliente)
    {
        $this->user = $user;
        $this->cliente = $cliente;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.register_imprenta');
    }
}
