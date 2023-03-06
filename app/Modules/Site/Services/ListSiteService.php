<?php
namespace App\Modules\Site\Services;

use App\Models\Site;

class ListSiteService {

    protected $site;

    public function __construct(Site $site)
    {
        $this->site = $site;
    }
    
    public function listSite($request, $serverId)
    {
        $sites = $this->site->where('server_id', $serverId)->get();
        
        if ($request->hasHeader('Content-Type')) { 
            return response()->json($sites, 200);
        } else {
            return view('modules.sites.index', compact('sites'), ['server' => $serverId]);
        }
    }

}