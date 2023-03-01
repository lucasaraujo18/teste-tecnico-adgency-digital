<?php 
namespace App\Modules\User\Services;

use App\Models\User;

use Carbon\Carbon;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

use App\Validators\UserValidators;
use App\Services\VerifyEmails\VerifyEmailService;

class CreateUserService 
{
    protected $user;
    protected $userValidator;
    protected $verifyEmail;

    public function __construct(User $user, UserValidators $userValidator, VerifyEmailService $verifyEmail)
    {
        $this->user = $user;
        $this->userValidator = $userValidator;
        $this->verifyEmail = $verifyEmail;
    }

    public function createUser()
    {
        return view('auth.create-user');
    }

    public function storeUser($request)
    {
        
        $payload = [
            'name' => $request->name,
            'email' => $request->email, 
            'email_verified' => false,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
            'privacy_terms' => $request->privacy_terms
        ];
        
        $validation = $this->userValidator->createUserValidator($payload);

        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()], 403);
        };

        
        DB::beginTransaction();
        
        try {
            unset($payload['password_confirmation']);

            $payload['password'] = Hash::make($payload['password']);

            $user = $this->user->create($payload);   

            DB::commit();

            Auth::login($user); 

            $this->verifyEmail->sendVerifyEmail($user->email);

            return view('auth.verify-email');

        } catch (\Throwable $errror) {
            DB::rollback();

            Log::warning("Ops:" . $errror);

            return $errror;
        }
    }
}

?>