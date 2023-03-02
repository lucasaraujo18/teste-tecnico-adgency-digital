<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Modules\GitHub\Services\GitHubService;

class GitHubController extends Controller
{
    protected $gitHubService;

    public function __construct(GitHubService $gitHubService)
    {       
        $this->gitHubService = $gitHubService;
    }

    public function gitRedirect() {
        $response = $this->gitHubService->gitRedirect();
        return $response;
    }

    public function gitCallBack() {
        $response = $this->gitHubService->gitCallBack();
        return $response;
    }
}
