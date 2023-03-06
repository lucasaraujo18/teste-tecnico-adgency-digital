<?php

namespace App\Modules\Site\Services;

use App\Models\Site;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Validators\SiteValidators;

class CreateSiteService {

    protected $site;
    protected $siteValidator;

    public function __construct(Site $site, SiteValidators $siteValidator)
    {
        $this->site = $site;
        $this->siteValidator = $siteValidator;
    }

    public function createSite($serverId) 
    {
        return view('modules.sites.create', ['server' => $serverId]);
    }

    public function storeSite($request) {
        $payload = [
            'name' => $request->name,
            'url' => $request->url, 
            'server_id' => $request->server_id,
            'deployment_url' => 'http://localhost:8000/api/deploy-url'
        ];

        $validation = $this->siteValidator->createSiteValidator($payload);

        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()], 403);
        };

        DB::beginTransaction();
        
        try {           
            $site = $this->site->create($payload);   

            DB::commit();

            return redirect('servers');

        } catch (\Throwable $error) {
            DB::rollback();

            Log::warning("Ops:" . $error);

            return $error;
        }
    }

}