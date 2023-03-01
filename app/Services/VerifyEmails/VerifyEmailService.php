<?php

namespace App\Services\VerifyEmails;

use App\Models\VerifyEmails;
use App\Models\User;


use Carbon\Carbon;

class VerifyEmailService 
{ 
    function sendVerifyEmail($email) {
        $user = User::where('email', $email)->where('email_verified', 0)->first();

        $receiverEmail = $user->email;
        $verifyCode = rand(100000, 999999);

        VerifyEmail::create([
            'email' => $receiverEmail,
            'verify_code' => $verifyCode
        ]);

        Mail::to($receiverEmail)->send(new VerifyEmail($user, $verifyCode));
    }
}

?>