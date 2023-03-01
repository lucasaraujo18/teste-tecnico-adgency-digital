<?php 
namespace App\Services\User;

use App\Models\User;

use Carbon\Carbon;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Validators\UserValidator;

class CreateUserService 
{
    public function __construct(User $user, UserValidator $UserValidator)
    {
        $this->user = $user;
        $this->userValidator = $userValidator;
    }

    public function createUser($request)
    {
        
        $payload = [
            'name' => $request->name,
            'email' => $request->name, 
            'email_verified' => false,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
            'privacy_terms' => $request->privacy_terms
        ];
        
        $validation = $userValidator->createUserValidator($payload);

        if ($validation->fails()) {
            return response()->json(['errors' => $validated->errors()], 403);
        };
        
        DB::beginTransaction();

        try {
           $data = array_splice($payload, 4);

            $user->create($data);   

            DB::commit();

            return view('components.content.verify.email', compact($user));

        } catch (\Throwable $errror) {
            DB::rollback();

            Log::warning("Ops:" . $errror);
        }
    }
}

?>