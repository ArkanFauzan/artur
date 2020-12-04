<?php

namespace App\Mail;

use App\Register;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class RegistrasiUMKM extends Mailable
{
    use Queueable, SerializesModels;

    public $register;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Register $register_user)
    {
        $this->register = $register_user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Registrasi UMKM Berhasil')
                    ->view('mail.register');
    }
}
