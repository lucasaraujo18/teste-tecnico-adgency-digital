<?php

namespace App\Modules\Server\Services;

use App\Models\Server;

use App\Modules\User\Repositories\GetUserRepository;

class CreateServerService {

    protected $server;
    protected $getUserRepository;

    public function __construct(Server $server, GetUserRepository $getUserRepository)
    {
        $this->server = $server;
        $this->getUserRepository = $getUserRepository;
    }

    public function createServer() 
    {
        return view('components.server.operations.create');
    }

    public function storeServer($request) {
        $user = $this->getUserRepository->findUserById((Auth::id()));
        $userId = $user->id;

        $payload = [
            'name' => $request->name,
            'ip' => $request->ip, 
            'user_id' => $userId,
        ];

        DB::beginTransaction();
        
        try {           
            $server = $this->server->create($payload);   

            DB::commit();

            return redirect()->route('server.index');

        } catch (\Throwable $error) {
            DB::rollback();

            Log::warning("Ops:" . $error);

            return $errsor;
        }
    }

}