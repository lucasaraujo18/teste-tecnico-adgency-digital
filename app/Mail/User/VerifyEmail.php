<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;
        public $verifyCode;
        public $userName;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userName, $verifyCode)
    {
        $this->userName = $userName;
        $this->verifyCode = $verifyCode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.users.send-mail-verify')
            ->subject('Bem vindo(a)')
            ->with([
                'userName' => $this->userName,
                'verifyCode' => $this->verifyCode,
            ]);
    }
}
