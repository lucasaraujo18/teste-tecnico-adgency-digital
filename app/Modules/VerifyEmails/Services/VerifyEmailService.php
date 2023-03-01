<?php

namespace App\Modules\Services\VerifyEmails;

use App\Models\VerifyEmails;
use App\Models\User;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;

use App\Mail\User\VerifyEmail;

class VerifyEmailService 
{ 
    public function sendVerifyEmail($email) {
        $user = User::where('email', $email)->where('email_verified', 0)->first();

        $receiverEmail = $user->email;
        $verifyCode = rand(100000, 999999);
        $userName = $user->name;
        
        DB::beginTransaction();

        try {
            VerifyEmails::create([
                'email' => $receiverEmail,
                'verify_code' => $verifyCode
            ]);

            DB::commit();

            Mail::to($receiverEmail)->send(new VerifyEmail($userName, $verifyCode));

        } catch (\Throwable $error) {
            DB::rollback();

            Log::warning("Ops:" . $errror);

            return $errror;
        }

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
            return response()->json(['errors' => $validation->errors()], 403);
        }

        $code = VerifyEmails::where('verify_email', $verifyCode)->get();        

        DB::beginTransaction();

        try {
            $code->status = 1;
            $code->save();
    
            $user->email_verified = 1;
            $user->email_verified_at = Carbon::now();
            $user->save();
    
            DB::commit();
            
            return redirect()->route('home');
            
        } catch (\Throwable $error) {
            DB::rollback();

            Log::warning("Ops:" . $errror);

            return $errror;
        }
    }
}

?>