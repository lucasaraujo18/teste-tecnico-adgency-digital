<?php 

namespace App\Modules\GitHub\Repositories;

use Illuminate\Support\Facades\Auth;

use App\Modules\User\Repositories\GetUserRepository;

class GitHubApiRepository {
    protected $getUserRepository;

    public function __construct(GetUserRepository $getUserRepository)
    {
        $this->getUserRepository = $getUserRepository;
    }

    public function gitHubApi() {
        $user = $this->getUserRepository->findUserById((Auth::id()));
        $token = $user->github_token;

        $apiUrl = 'https://api.github.com';

        $headers = [
            'Accept' => 'application/vnd.github+json',
            'Authorization' => 'Bearer ' . $token,
            'X-GitHub-Api-Version' => '2022-11-28'
        ];

        return ['apiUrl' => $apiUrl, 'headers' => $headers];
    }

}