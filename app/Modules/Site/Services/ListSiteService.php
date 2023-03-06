<?php
namespace App\Modules\Site\Services;

use App\Models\Site;

class ListSiteService {

    protected $site;

    public function __construct(Site $site)
    {
        $this->site = $site;
    }

    public function viewListSite($serverId)
    {
        $sites = $this->site->where('server_id', $serverId)->get();

        return view('modules.sites.index', compact('sites'), ['server' => $serverId]);
    }

    public function deployListSite($serverId)
    {
        $sites = $this->site->where('server_id', $serverId)->get();
        
        return response()->json($sites, 200);
    }

}