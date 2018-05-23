<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Order extends Mailable {
    use Queueable, SerializesModels;


    /**
     * The order instance.
     *
     * @var Order
     */
    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dados, $user, $certidao, $cartorio) {
        $this->order = $dados;
        $this->user = $user;
        $this->certidao = $certidao;
        $this->cartorio = $cartorio;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->from('order@cartorio24horas.net')->view('mail.order');
    }
}
