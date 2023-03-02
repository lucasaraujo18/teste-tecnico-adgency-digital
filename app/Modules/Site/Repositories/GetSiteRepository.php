<?php 

namespace App\Modules\Site\Repositories;

use App\Models\Site;

class GetSiteRepository {
    protected $site;

    public function __construct(Site $site)
    {
        $this->site = $site;
    }

    public function findSiteById($id)
    {
        $site = $this->site->find($id);

        return $site;
    }
}