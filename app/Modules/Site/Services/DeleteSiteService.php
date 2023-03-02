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
        
        DB::beginTransaction();

        try {           
            $site = $this->site->where('id', $deleteSite->id)->delete();   

            DB::commit();

            return redirect()->back();

        } catch (\Throwable $error) {
            DB::rollback();

            Log::warning("Ops:" . $error);

            return $error;
        }
        
    }

}