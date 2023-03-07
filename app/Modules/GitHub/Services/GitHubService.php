<?php
namespace App\Modules\GitHub\Services;

use App\Models\User;
use App\Models\Server;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use Socialite;
use Carbon\Carbon;

use App\Modules\GitHub\Repositories\GitHubApiRepository;
use App\Modules\User\Repositories\GetUserRepository;

class GitHubService {
    protected $gitHubApiRepository;
    protected $getUserRepository;
    protected $server;

    public function __construct(GitHubApiRepository $gitHubApiRepository, 
                                GetUserRepository $getUserRepository,
                                Server $server)
    {
        $this->gitHubApiRepository = $gitHubApiRepository;
        $this->getUserRepository = $getUserRepository;
        $this->server = $server;
    }

    public function listRepositories() {
        return view('modules.github.index');
    }

    public function gitRedirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function gitCallback()
    {
        try {
            $userGit = Socialite::driver('github')->user();
      
            $searchUser = User::where('github_id', $userGit->id)->first();

            $user = $this->getUserRepository->findUserById((Auth::id()));

            if ($searchUser) {
      
                Auth::login($searchUser);
     
                return redirect('home');

            } else { 
                $newUser = User::create([
                    'name' => $userGit->name,
                    'email' => $userGit->email,
                    'github_id'=> $userGit->id,
                    'github_username' => $userGit->nickname,
                    'avatar' => $userGit->avatar,
                    'github_token' => $userGit->token,
                    'auth_type'=> 'github',
                    'password' => encrypt('gitpwd059'),
                    'git_hub_connect' => 1,
                    'privacy_terms' => 1,
                    'email_verified_at' => Carbon::now(),
                    'email_verified' => 1
                ]);
                if ($user) {
                    $servers = $this->server->where('user_id', $user->id)->get();

                    foreach ($servers as $server) {
                        $server->user_id = $newUser->id;
                        $server->save();
                    }

                    $user->delete();
                    
                    DB::commit();             
                }
                
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
        $gitHubApi = $this->gitHubApiRepository->gitHubApi();
        $url = $gitHubApi['apiUrl'];
        $headers = $gitHubApi['headers'];

        $reponse = Http::withHeaders($headers)->get($url . '/user/repos');

        $gitRepositories = $reponse->json();

        return $gitRepositories;

    }

}