<?php 
namespace App\Services\User;

use App\Models\User;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class CreateUserService 
{
    public function CreateUser($request)
    {
        DB::beginTransaction();

        try {
            $user->create([
                'name' => $request->name,
                'email' => $request->name, 
                'email_verified' => false,
                'password' => $request->password,
                'privacy_terms' => $request->privacy_terms
            ]);   

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
        }
    }
}

?>