<?php

namespace App\Http\Controllers;

use App\Models\Server;

use Illuminate\Http\Request;

use App\Modules\Server\Services\CreateServerService;
use App\Modules\Server\Services\ListServerService;
use App\Modules\Site\Services\ListSiteService;
use App\Modules\Server\Services\DeleteServerService;

class ServerController extends Controller
{
    protected $server;
    protected $createServerService;
    protected $listServerService;
    protected $deleteSiteService;

    public function __construct(Server $server, 
                                CreateServerService $createServerService, 
                                ListServerService $listServerService,
                                ListSiteService $listSiteService,
                                DeleteServerService $deleteServerService)
    {
        $this->server = $server;
        $this->createServerService = $createServerService;
        $this->listServerService = $listServerService;
        $this->listSiteService = $listSiteService;
        $this->deleteServerService = $deleteServerService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $response = $this->listServerService->listServer($request);
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = $this->createServerService->createServer();
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = $this->createServerService->storeServer($request);
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->deleteServerService->deleteServer($id);
        return $response;
    }

    public function listSite($id)
    {
        $response = $this->listSiteService->listSite($id);
        return $response;
    }
}
