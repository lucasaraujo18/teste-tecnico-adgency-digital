<?php

namespace App\Modules\Site\Services;

use App\Models\Site;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Modules\Site\Repositories\GetSiteRepository;

class DeleteSiteService {

    protected $site;
    protected $getSiteRepository;

    public function __construct(Site $site, GetSiteRepository $getSiteRepository)
    {
        $this->site = $site;
        $this->getSiteRepository = $getSiteRepository;
    }

    public function deleteSite($id) 
    {
        $deleteSite = $this->getSiteRepository->findSiteById($id);

        try {           
            $site = $this->site->delete($deleteSite);   

            DB::commit();

            return redirect('servers');

        } catch (\Throwable $error) {
            DB::rollback();

            Log::warning("Ops:" . $error);

            return $error;
        }
        
    }

}