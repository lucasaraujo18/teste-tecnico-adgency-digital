<?php

namespace App\Modules\Server\Services;

use App\Models\Server;

use App\Modules\User\Repositories\GetUserRepository;
use App\Validators\ServerValidators;

class CreateServerService {

    protected $server;
    protected $getUserRepository;
    protected $serverValidator;


    public function __construct(Server $server, GetUserRepository $getUserRepository, ServerValidators $serverValidator)
    {
        $this->server = $server;
        $this->getUserRepository = $getUserRepository;
        $this->serverValidator = $serverValidator;
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

        $validation = $this->serverValidator->createServerValidator($payload);

        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()], 403);
        };

        DB::beginTransaction();
        
        try {           
            $server = $this->server->create($payload);   

            DB::commit();

            return redirect()->route('server.index');

        } catch (\Throwable $error) {
            DB::rollback();

            Log::warning("Ops:" . $error);

            return $error;
        }
    }

}