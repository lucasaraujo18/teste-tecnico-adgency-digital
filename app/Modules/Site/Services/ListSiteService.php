<?php
namespace App\Modules\Site\Services;

use App\Models\Site;

class ListSiteService {

    protected $site;

    public function __construct(Site $site)
    {
        $this->site = $site;
    }

    public function listSite($serverId)
    {
        $sites = $this->site->where('server_id', $serverId)->get();

        return view('components.sites.index', compact('sites'), ['server' => $serverId]);
    }

}