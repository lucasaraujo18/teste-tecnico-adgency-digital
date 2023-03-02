<?php 

namespace App\Modules\Server\Repositories;

use App\Models\Server;

class GetServerRepository {
    protected $server;

    public function __construct(Server $server)
    {
        $this->server = $server;
    }

    public function findServerById($id)
    {
        $server = $this->server->find($id);

        return $server;
    }
}