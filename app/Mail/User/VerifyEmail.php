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
        public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($verifyCode, $user)
    {
        $this->user = $user;
        $this->verifyCode = $verifyCode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.user.send-mail-verify')
            ->subject('Bem vindo(a)')
            ->with([
                'user' => $this->user,
                'email' => $this->email,
                'route' => route('users.index'),
            ]);
    }
}
