<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailFaleConosco extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $name, $tel, $email, $mensagem;


    public function __construct($data)
    {
        $this->name = $data['name'];
        $this->tel = $data['tel'];
        $this->email = $data['cemail'];
        $this->mensagem = $data['mensagem'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->replyTo($this->email, $this->name);
        $this->subject('Fale Conosco: '.$this->name);
        return $this->view('mails.faleconosco');
    }
}
