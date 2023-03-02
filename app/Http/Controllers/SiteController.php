<?php

namespace App\Http\Controllers;

use App\Models\Site;

use Illuminate\Http\Request;

use App\Modules\Site\Services\CreateSiteService;
use App\Modules\Site\Services\ListSiteService;
use App\Modules\Site\Services\DeleteSiteService;

class SiteController extends Controller
{
    protected $site;
    protected $createSiteService;
    protected $listSiteService;

    public function __construct(Site $site, 
                                CreateSiteService $createSiteService, 
                                ListSiteService $listSiteService,
                                DeleteSiteService $deleteSiteService)
    {
        $this->site = $site;
        $this->createSiteService = $createSiteService;
        $this->listSiteService = $listSiteService;
        $this->deleteSiteService = $deleteSiteService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexByServer($id)
    {
        $response = $this->listSiteService->listSite($id);
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createByServer($id)
    {
        $response = $this->createSiteService->createSite($id);
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
        $response = $this->createSiteService->storeSite($request);
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
        $response = $this->deleteSiteService->deleteSite($id);
        return $response;
    }
}
