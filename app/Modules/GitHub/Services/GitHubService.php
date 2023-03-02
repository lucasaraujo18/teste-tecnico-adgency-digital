<?php
namespace App\Modules\GitHub\Services;

use App\Models\User;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use Socialite;
use Carbon\Carbon;

use App\Modules\GitHub\Repositories\GitHubApiRepository;

class GitHubService {
    protected $gitHubApiRepository;

    public function __construct(GitHubApiRepository $gitHubApiRepository)
    {
        $this->gitHubApiRepository = $gitHubApiRepository;
    }

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
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'github_id'=> $user->id,
                    'github_username' => $user->nickname,
                    'avatar' => $user->avatar,
                    'github_token' => $user->token,
                    'auth_type'=> 'github',
                    'password' => encrypt('gitpwd059'),
                    'git_hub_connect' => 1,
                    'privacy_terms' => 1,
                    'email_verified_at' => Carbon::now(),
                    'email_verified' => 1
                ]);

                DB::commit();
     
                Auth::login($newUser);
      
                return redirect('home');
            }
     
        } catch (\Throwable $error) {
            DB::rollback();

            Log::warning("Ops:" . $error);

            return $error;
        }
    }


    public function gitUserRepo() 
    {
        $githubApi = $this->gitHubApiRepository->gitHubApi();
        $url = $githubApi['apiUrl'];
        $headers = $githubApi['headers'];

        $reponse = Http::withHeaders($headers)->get($url . '/user/repos');

        $repositories = $reponse->json();

        return $repositories;

    }

}