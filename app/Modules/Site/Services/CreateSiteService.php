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
        return view('components.site.create', ['server' => $serverId]);
    }

    public function storeSite($request) {
        $payload = [
            'name' => $request->name,
            'url' => $request->url, 
            'server_id' => $request->server_id,
        ];

        $validation = $this->siteValidator->createSiteValidator($payload);

        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()], 403);
        };

        DB::beginTransaction();
        
        try {           
            $site = $this->site->create($payload);   

            DB::commit();

            return redirect()->route('site.index');

        } catch (\Throwable $error) {
            DB::rollback();

            Log::warning("Ops:" . $error);

            return $error;
        }
    }

}