<?php

namespace App\Modules\Server\Services;

use App\Models\Server;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Modules\Server\Repositories\GetServerRepository;

class DeleteServerService {

    protected $server;
    protected $getServerRepository;

    public function __construct(Server $server, GetServerRepository $getServerRepository)
    {
        $this->server = $server;
        $this->getServerRepository = $getServerRepository;
    }

    public function deleteServer($id) 
    {
        $deleteServer = $this->getServerRepository->findServerById($id);
        
        DB::beginTransaction();

        try {           
            $server = $this->server->where('id', $deleteServer->id)->delete();   

            DB::commit();

            return redirect()->back();

        } catch (\Throwable $error) {
            DB::rollback();

            Log::warning("Ops:" . $error);

            return $error;
        }
        
    }

}