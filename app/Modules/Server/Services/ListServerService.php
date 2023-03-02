<?php
namespace App\Modules\Server\Services;

use App\Models\Server;

use Illuminate\Support\Facades\Auth;

use App\Modules\User\Repositories\GetUserRepository;

class ListServerService {

    protected $server;
    protected $getUserRepository;

    public function __construct(Server $server, GetUserRepository $getUserRepository)
    {
        $this->server = $server;
        $this->getUserRepository = $getUserRepository;
    }

    public function listServer($request)
    {
        $user = $this->getUserRepository->findUserById((Auth::id()));
        $userId = $user->id;

        $servers = $this->server->where('user_id', $userId)->get();

        return view('components.servers.index', compact('user', 'servers'));
    }

}