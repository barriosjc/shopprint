<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ordencompraMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $oc = null;
    public $cliente = null;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($oc, $cliente)
    {
        $this->oc = $oc;
        $this->cliente = $cliente;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.orden_compra');
    }
}
