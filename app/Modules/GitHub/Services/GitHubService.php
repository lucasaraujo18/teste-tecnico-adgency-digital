<?php
namespace App\Modules\GitHub\Services;

use App\Models\User;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Socialite;
use Auth;
use Carbon\Carbon;

class GitHubService {
    public function gitRedirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function gitCallback()
    {
        try {
     
            $user = Socialite::driver('github')->user();
      
            $searchUser = User::where('github_id', $user->id)->first();
      
            if ($searchUser) {
      
                Auth::login($searchUser);
     
                return redirect('home');

            } else { 

                $gitUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'github_id'=> $user->id,
                    'auth_type'=> 'github',
                    'password' => encrypt('gitpwd059'),
                    'git_hub_connect' => 1,
                    'privacy_terms' => 1,
                    'email_verified_at' => Carbon::now(),
                    'email_verified' => 1
                ]);

                DB::commit();
     
                Auth::login($gitUser);
      
                return redirect('home');
            }
     
        } catch (\Throwable $error) {
            DB::rollback();

            Log::warning("Ops:" . $error);

            return $error;
        }
    }

}