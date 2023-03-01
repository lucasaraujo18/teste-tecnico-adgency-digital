<?php 
namespace App\Services\User;

use App\Models\User;

use Carbon\Carbon;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

use App\Validators\UserValidators;

class CreateUserService 
{
    protected $user;
    protected $userValidator;

    public function __construct(User $user, UserValidators $userValidator)
    {
        $this->user = $user;
        $this->userValidator = $userValidator;
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

            return $user;

        } catch (\Throwable $errror) {
            DB::rollback();

            Log::warning("Ops:" . $errror);

            return $errror;
        }
    }
}

?>