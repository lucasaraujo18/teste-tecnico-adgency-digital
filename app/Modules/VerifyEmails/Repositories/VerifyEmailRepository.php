<?php

namespace App\Modules\VerifyEmails\Repositories;

use App\Models\VerifyEmails;

class VerifyEmailRepository {

    protected $verifyEmails;

    public function __construct(VerifyEmails $verifyEmails)
    {
        $this->verifyEmails = $verifyEmails;
    }

    public function verifyByCode($code)
    {
        $verify = $this->verifyEmails->where('verify_email', $verifyCode)->get();   

        return $verify;
    }

}