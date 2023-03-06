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
        $servers = $this->server->all();

        if ($request->hasHeader('Content-Type')) {
            return response()->json($servers, 200);
        } else {
            return view('modules.servers.index', compact('servers'));
        }

    }
}