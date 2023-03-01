<?php

namespace App\Services\VerifyEmails;

use App\Models\VerifyEmails;
use App\Models\User;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use App\Mail\User\VerifyEmail;

class VerifyEmailService 
{ 
    public function sendVerifyEmail($email) {
        $user = User::where('email', $email)->where('email_verified', 0)->first();

        $receiverEmail = $user->email;
        $verifyCode = rand(100000, 999999);
        $userName = $user->name;

        VerifyEmails::create([
            'email' => $receiverEmail,
            'verify_code' => $verifyCode
        ]);

        Mail::to($receiverEmail)->send(new VerifyEmail($userName, $verifyCode));
    }

    public function verifyCode($request)
    {
        $verifyCode = $request->verify_code;

        $user = User::find(Auth::id());

        $rules = [
            'verify_code' => ['required']
        ];

        $messages = [
            'required' => "Este campo é de preenchimento obrigatório.",
        ];

        $validation = Validator::make($request->all(), $rules, $messages);

        if ($validation->fails()) {
            return response()->json(['errors' => $validated->errors()], 403);
        }

        $code = VerifyEmails::where('verify_code', $verifyCode)->orderBy('id', 'DESC')->first();

        if ($verifyCode == $code->verify_code) {
            $code->status = 1;
            $code->save();

            $user->email_verified = 1;
            $user->email_verified_at = Carbon::now();
            $user->save();

            return view('auth.verify-email');
        } else {
            return response()->json(['errors' => ['verify_code' => ['Código de verificação inválido. Preencha novamente.']]], 403);
        }
    }

    
}

?>