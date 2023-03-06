<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Modules\WebHook\Services\WebHookService;

class WebHookController extends Controller
{
    protected $webHookService;

    
    public function __construct(WebHookService $webHookService)
    {       
        $this->webHookService = $webHookService;
    }

    public function webhook(Request $request)
    {
        $response = $this->webHookService->webHook($request);
        return $response;
    }

}
