<?php
namespace App\Modules\Site\Services;

use App\Models\Site;

class ListSiteService {

    protected $site;

    public function __construct(Site $site)
    {
        $this->site = $site;
    }

    public function ListSite($request)
    {
        $sites = $this->site->where('user_id', $userId)->get();

        return view('components.site.index', compact('user', 'sites'));
    }

}